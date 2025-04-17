<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {

        return Inertia::render('User/Index', [
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

        return Inertia::render('User/Edit', $this->formData($user, "create"));
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
        return Inertia::render('User/Edit', $this->formData($user, "edit"));
    }

    public function updateUser(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:200',
            'email' => 'required|string|email|max:255',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'), 
            'status' => 'active',
            'mark' => $request->input('mark'),
        ]);

        return redirect()->route('users.all')->with('success', 'User created successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('users.all')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('users.all')->with('error', 'User not found.');
        }
    }
}
