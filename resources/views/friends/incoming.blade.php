@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="w-full max-w-xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">📥 Incoming Friend Requests</h2>

        @if($requests->isEmpty())
            <p class="text-center text-gray-500">No incoming friend requests.</p>
        @else
            <div class="space-y-4">
                @foreach($requests as $request)
                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
                        <div>
                            <p class="text-base font-semibold text-gray-800">{{ $request->sender->name }}</p>
                            <p class="text-sm text-gray-600">{{ $request->sender->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('friends.respond', $request->id) }}" class="flex space-x-2">
                            @csrf
                            <button name="status" value="accepted" type="submit"
                                    class="px-3 py-1 bg-green-600 text-blue text-sm rounded hover:bg-green-700 transition">
                                Accept
                            </button>
                            <button name="status" value="rejected" type="submit"
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                Reject
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
