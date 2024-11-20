<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Show the settings page
    public function index()
{
    $settings = [
        'site_name' => 'Techqourum Solutions',
        'email_notifications' => true,
        'theme' => 'light',
        'language' => 'en',
        'date_format' => 'Y-m-d',
        'notification_frequency' => 'daily',
    ];

    return view('settings.index', compact('settings'));
}


    // Update the settings
    public function update(Request $request)
    {
        // Validate and process the incoming data
        $validated = $request->validate([
            'setting_name' => 'required|string|max:255',
            // Add other settings fields here
        ]);

        // Save settings to database or wherever necessary
        // Example: Setting::update($validated);
        
        return redirect()->route('settings')->with('success', 'Settings updated successfully!');
    }
}
