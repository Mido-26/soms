@extends('layouts.app')

@section('title', 'Settings')
@section('name', 'Settings')

@section('content')
    @include('layouts.back')

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Settings</h2>

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- General Settings -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-cogs text-indigo-600 mr-2"></i> General Settings
                </h3>
                <div class="space-y-4">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-600">Site Name</label>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-font text-gray-600 mr-3"></i>
                            <input type="text" name="site_name" id="site_name" 
                                   class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-300" 
                                   value="{{ old('site_name', $settings->site_name ?? '') }}">
                        </div>
                    </div>
                    <div>
                        <label for="timezone" class="block text-sm font-medium text-gray-600">Timezone</label>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-clock text-gray-600 mr-3"></i>
                            <select name="timezone" id="timezone" 
                                    class="w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-indigo-300">
                                @foreach(timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" 
                                        {{ ($settings->timezone ?? '') == $timezone ? 'selected' : '' }}>
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-bell text-indigo-600 mr-2"></i> Notification Settings
                </h3>
                <div class="space-y-4">
                    <div>
                        <label for="email_notifications" class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-gray-600 mr-2"></i>
                            <input type="checkbox" name="email_notifications" id="email_notifications" 
                                   class="h-4 w-4 text-indigo-600 focus:ring focus:ring-indigo-300"
                                   {{ $settings->email_notifications ?? false ? 'checked' : '' }}>
                            <span class="text-sm text-gray-600">Enable Email Notifications</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
