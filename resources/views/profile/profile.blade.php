@extends('layouts.app')
@section('title', 'Edit Member')
@section('name', 'Your Profile')
@section('content')
    <div class="bg-white px-6 py-4 shadow-md rounded gap-4">
        <div class="flex justify-between items-center bg-gradient-to-r from-orange-400 to-gray-600 p-6 rounded-t-lg">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <!-- Profile Picture -->
                    <img src="../../assets/logo/logo2.png" alt="Profile Picture"
                        class="w-20 h-20 rounded-full border-4 border-white mx-auto sm:mx-0">
                    <!-- Edit Icon -->
                    <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full">
                        <i class="fas fa-camera text-green-400"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-500 mt-4 pt-4"></div>
        <!-- Form to view  User profile -->
        {{-- @include('layouts.sess_msg') --}}
        @if (session('success1'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success1') }}
            </div>
        @endif
        <form action="{{ route('profile.update', $user->id) }}" method="post" class="max-w-md mb-6 ">
            @csrf
            @method('PATCH')
            <h2 class="text-lg font-semibold mb-4">Profile Information</h2>
            <!-- First Name Field -->
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name"
                        pattern="^[A-Za-z\s'-]{2,50}$"
                        title="First name should contain only letters, spaces, apostrophes, or hyphens."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value=" {{ old('first_name', $user->first_name) }}" required>

                </div>
                @error('first_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name Field -->
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                        pattern="^[A-Za-z\s'-]{2,50}$"
                        title="Last name should contain only letters, spaces, apostrophes, or hyphens."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('last_name', $user->last_name) }}" required>

                </div>
                @error('last_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" placeholder="Email"
                        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                        title="Please enter a valid email address."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('email', $user->email) }}" required>

                </div>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-phone text-gray-400"></i>
                    </div>
                    <input type="tel" id="phone_number" name="phone_number" placeholder="Phone Number"
                        pattern="^\+?[0-9]{10,15}$"
                        title="Please enter a valid phone number (10-15 digits, can start with +)."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('phone_number', $user->phone_number) }}" required>

                </div>
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
         {{-- Date of Birth field --}}
         <div class="mb-6">
            <div class="mb-0 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa fa-calendar text-gray-400"></i>
                </div>
                <input type="date" id="Date_OF_Birth" name="Date_OF_Birth" placeholder="Date_OF_Birth"
                    pattern="^[A-Za-z\s'-]{2,50}$"
                    title="Date is required."
                    class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ old('Date_OF_Birth ', $user->Date_OF_Birth) }}" required>

            </div>
            @error('Date_OF_Birth')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Address location field --}}
        <div class="mb-6">
            <div class="mb-0 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-user text-gray-400"></i>
                </div>
                <input type="text" id="Address" name="Address" placeholder="Address"
                    pattern="^[A-Za-z\s'-]{2,50}$"
                    title="Address should contain only letters, spaces, apostrophes, or hyphens."
                    class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ old('Address', $user->Address) }}" required>

            </div>
            @error('Address')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-xl shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-edit mr-2"></i>
                Update Your Profile
            </button>
        </form>
        <div class="border-t border-gray-500 mt-4 pt-4"></div>

        @if (session('success2'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success2') }}
            </div>
        @endif
        <!-- Password Update Form -->
        <form action="{{ route('profile.updatePassword', $user->id) }}" method="post" class="max-w-md mb-6">
            @csrf
            @method('PATCH')
            <h2 class="text-lg font-semibold mb-4">Change Password</h2>
        
            <!-- Current Password -->
            <div class="mb-6">
                <label class="block text-gray-700">Current Password</label>
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="CurrentPassword" value="{{ old('CurrentPassword') }}"
                        name="CurrentPassword" placeholder="Current Password"
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                @error('CurrentPassword')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- New Password -->
            <div class="mb-6">
                <label class="block text-gray-700">New Password</label>
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="NewPassword"  value="{{ old('NewPassword') }}"
                        name="NewPassword" placeholder="New Password"
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                @error('NewPassword')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-gray-700">Confirm Password</label>
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="NewPassword_confirmation" value="{{ old('NewPassword_confirmation') }}""
                        name="NewPassword_confirmation" placeholder="Confirm Password"
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                @error('NewPassword_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <!-- Change Password Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-xl shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-edit mr-2"></i>
                Update Your Password
            </button>
        </form>
        


    </div>
@endsection
