<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {

        return Inertia::render('Dashboard', [
            'users' => User::where('status', 'active')->get(),
        ]);
    }

    public function create()
    {
        $user = User::where('status', 'draft')->first();
        if (!$user) {
            $user = User::create([
                'name' => '',
                'email' => '',
                'password' => Hash::make('password'), // Default password, you can change this as needed
                'status' => 'draft',
            ]);
        }

        return Inertia::render('CreateUser', $this->formData($user, "create"));
    }

    protected function formData($user, $type)
    {
        return [
            'userData' => $user,
            'type' => $type,
        ];
    }

    public function editUser(int $id){
        $user = User::find($id);
        return Inertia::render('CreateUser', $this->formData($user, "edit"));
    }

    public function updateUser(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:255',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), 
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('dashboard')->with('error', 'User not found.');
        }
    }
}
