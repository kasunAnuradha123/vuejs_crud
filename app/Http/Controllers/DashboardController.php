<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        
        return Inertia::render('Dashboard', [
            'users' => User::all()
        ]);
    }

    public function create(){
        return Inertia::render('CreateUser');
    }

    public function createUser(Request $request){
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Default password, you can change this as needed
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function deleteUser($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('dashboard')->with('error', 'User not found.');
        }
    }
}
