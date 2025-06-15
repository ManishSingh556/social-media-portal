<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
{
    $user = Auth::user();
    // dd($user);
    // $user = User::all('users')->where('id')->first();
    return view('users.index', compact('user'));
}

 public function edit()
 {
    return view('users.edit', ['user' => Auth::user()]);
 }

public function update(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string',
        'bio' => 'nullable|string',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
       Storage::disk('public')->putFileAs('profile_images', $file, $filename);
        $user->avatar = 'profile_images/' . $filename;
        $user->avatar = 'profile_images/' . $filename;
    }
    $user->fill($data);
    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully!');
}


}
