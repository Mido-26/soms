<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'password' => 'required|string|min:6',
            'Date_OF_Birth' => 'required|date',
            'Address' => 'required|string',
        ]);

        // dd($request->all());
        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'Date_OF_Birth' => $request->Date_OF_Birth,
            'Address' => $request->Address,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        return redirect()->route('members.create')->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        // dd($user);
        return view('members.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('members.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $member)
    {

        // dd($request->route('todo'));

        $todo = $request->route('todo');
    
        if ($todo === 'status') {
            $member->status = $member->status === 'active' ? 'inactive' : 'active';
            $member->save();
            return redirect()->route('members.edit', $member->id)->with('success', 'Account status changed successfully!');
        }
    
        if ($todo === 'reset') {
            $member->password = Hash::make('password');
            $member->save();
            return redirect()->route('members.edit', $member->id)->with('success', 'Password reset successfully!');
        }
    
        // Standard update logic for other fields
        $data = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'Date_OF_Birth' => 'required|date',
            'Address' => 'required|string',
        ]);
    
        $member->update($data);
    
        return redirect()->route('members.edit', $member->id)->with('success', 'User updated successfully!');
    }
    


     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
