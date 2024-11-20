@extends('layouts.app')
@section('title', 'Create Member')
@section('name', 'Register Member')
@section('content')
    <div class="bg-white p-6 shadow-md rounded">
        @include('layouts.back')
        
        <!-- Form to Register User -->
        @include('layouts.sess_msg')
        <form action="{{ route('members.store') }}" method="post" class="max-w-md mb-6">
            @csrf
            @method('POST')
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
                        value="{{ old('first_name') }}" required>

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
                        value="{{ old('last_name') }}" required>

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
                        value="{{ old('email') }}" required>

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
                        value="{{ old('phone_number') }}" required>

                </div>
                @error('phone_number')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Date of Birth field --}}
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-gray-400"></i>
                    </div>
                    <input type="date" id="Date_OF_Birth" name="Date_OF_Birth" placeholder="Date_OF_Birth"
                        pattern="^[A-Za-z\s'-]{2,50}$"
                        title="Date is required."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('Date_OF_Birth') }}" required>

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
                    <input type="address" id="Address" name="Address" placeholder="Address"
                        pattern="^[A-Za-z\s'-]{2,50}$"
                        title="Address should contain only letters, spaces, apostrophes, or hyphens."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ old('Address') }}" required>

                </div>
                @error('Address')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Password Field -->
            <div class="mb-6">
                <div class="mb-0 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" id="password" name="password" placeholder="Password" 
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                        title="Password must be at least 8 characters long, with at least one uppercase letter, one lowercase letter, one number, and one special character."
                        class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>

                </div>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fa-solid fa-circle-plus mr-2"></i>
                Add Member
            </button>
        </form>
    </div>

@endsection
