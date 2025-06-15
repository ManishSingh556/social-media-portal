@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="w-full max-w-xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔍 Search Users</h2>

        <form method="GET" action="{{ route('friends.search') }}" class="flex justify-center mb-8">
            <input type="text" name="query" placeholder="Search by name or email"
                   value="{{ request('query') }}"
                   class="w-2/3 px-3 py-2 border border-gray-300 rounded-l-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-r-md hover:bg-indigo-700 transition">
                Search
            </button>
        </form>


        @if(request('query'))
            @if($users->isEmpty())
                <p class="text-center text-gray-500">No users found.</p>
            @else
                <div class="space-y-4">
                    @foreach($users as $user)
                        @if($user->id !== auth()->id())
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
                                <div>
                                    <p class="text-base font-semibold text-gray-800">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $user->bio ?? 'No bio available' }}</p>
                                </div>

                                @php
                                    $isRequested = in_array($user->id, $requestedUserIds ?? []);
                                    $isFriend = in_array($user->id, $friendIds ?? []);
                                @endphp


                                @if($isRequested)
                                    <button disabled
                                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded cursor-not-allowed">
                                        ✅ Already Sent Requested
                                    </button>
                                @elseif($isFriend)
                                     <button disabled
                                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm rounded cursor-not-allowed">
                                        ✅ Already Friends
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('friends.send', $user->id) }}">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-black text-sm rounded hover:bg-blue-700 transition">
                                            ➕ Send Request
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
