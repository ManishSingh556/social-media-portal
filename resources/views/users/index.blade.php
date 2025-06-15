@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="w-full max-w-xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 border-b pb-3">👤 Profile Overview</h2>

            <div class="flex flex-col items-center mb-6">
                {{-- Avatar --}}
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full">

                @else
                    <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-600 shadow border">
                        No Image
                    </div>
                @endif

                <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $user->name }}</h3>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>

            <div class="space-y-3 text-sm text-gray-700">
                <div class="flex justify-between border-b py-2">
                    <span class="font-medium">Contact:</span>
                    <span>{{ $user->contact ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b py-2">
                    <span class="font-medium">Bio:</span>
                    <span>{{ $user->bio ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('users.edit') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    ✏️ Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
