@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="w-full max-w-xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">👥 Friends List</h2>

        @if($friends->isEmpty())
            <p class="text-center text-gray-500">You have no friends yet.</p>
        @else
            <div class="space-y-4">
                @foreach($friends as $friend)
                    @php
                        $friendUser = $friend->sender_id == auth()->id() ? $friend->receiver : $friend->sender;
                    @endphp

                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg shadow-sm">
                         <div class="flex flex-col items-center mb-6">
                {{-- Avatar --}}
                @if($friendUser->avatar)
                    <img class="w-28 h-28 rounded-full object-cover shadow border" 
                         src="{{ asset('storage/' . $friendUser->avatar) }}" 
                         alt="Profile Image">
                @else
                    <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-600 shadow border">
                        No Image
                    </div>
                @endif

                <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $friendUser->name }}</h3>
                <p class="text-sm text-gray-500">{{ $friendUser->email }}</p>
            </div>
                        <!-- <div>
                            <p class="text-base font-semibold text-gray-800">{{ $friendUser->name }}</p>
                            <p class="text-sm text-gray-600">{{ $friendUser->email }}</p>
                        </div> -->
                        <form method="POST" action="{{ route('friends.remove', $friendUser->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
