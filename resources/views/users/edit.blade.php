@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white py-10">
    <div class="w-full max-w-xl mx-auto px-4">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3 text-center">✏️ Edit Profile</h2>

            <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>

                
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea name="bio" id="bio" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">{{ $user->bio }}</textarea>
                </div>

        
                <div>
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <input type="text" name="contact" id="contact" value="{{ $user->contact }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>

        
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700">Profile Image</label>
                    <input type="file" name="avatar" id="avatar"
                        class="mt-1 block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4
                               file:rounded-md file:border-0
                               file:text-sm file:font-semibold
                               file:bg-blue-50 file:text-blue-700
                               hover:file:bg-blue-100">
                </div>

            
                <div class="pt-6 flex justify-between">
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md text-sm font-medium text-gray-800 hover:bg-gray-300">
                        ← Back
                    </a>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-blue-600 rounded-md text-sm font-medium text-black hover:bg-blue-700">
                        ✅ Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
