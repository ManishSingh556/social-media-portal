<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\FriendRequestMail;

class FriendController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $authId = Auth::id();
        $users = User::where('id', '!=', $authId)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%");
            })->get();
        $friendIds = FriendRequest::where(function ($q) use ($authId) {
                $q->where('sender_id', $authId)
                ->orWhere('receiver_id', $authId);
            })->where('status', 'accepted')  ->get() ->map(function ($friend) use ($authId) {
                return $friend->sender_id == $authId ? $friend->receiver_id : $friend->sender_id;
            })->toArray();

        $requestedUserIds = FriendRequest::where('sender_id', $authId)->where('status', 'pending') ->pluck('receiver_id') ->toArray();
            return view('friends.search', compact('users', 'friendIds', 'requestedUserIds'));
    }




    public function send($id)
    {
        $sender = Auth::user();
    $receiver = User::findOrFail($id);

    FriendRequest::create([
        'sender_id' => $sender->id,
        'receiver_id' => $receiver->id,
        'status' => 'pending',
    ]);

    Mail::to($receiver->email)->queue(new FriendRequestMail($sender));

    return back()->with('success', 'Friend request sent and email queued!');
    }

    public function incoming()
    {
        $requests = FriendRequest::where('receiver_id', Auth::id())->where('status', 'pending')->get();
        return view('friends.incoming', compact('requests'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);
        $friendRequest = FriendRequest::findOrFail($id);
        $friendRequest->update(['status' => $request->status]);
        return back()->with('success', 'Response recorded');
    }

    public function list()
    {
        $friends = FriendRequest::where(function($q){
            $q->where('sender_id', Auth::id())
              ->orWhere('receiver_id', Auth::id());
        })->where('status', 'accepted')->get();

        return view('friends.list', compact('friends'));
    }

    public function remove($id)
    {
        FriendRequest::where(function ($q) use ($id) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $id)
              ->orWhere('receiver_id', Auth::id())->where('sender_id', $id);
        })->delete();

        return back()->with('success', 'Friend removed');
    }
}
