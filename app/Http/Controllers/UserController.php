<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        if ($user->can('view all users')) {
            $users = User::all();
            return view('users.index', compact('users'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function show($id)
    {
        /** @var \App\Models\User */
        $user = Auth::user(); 

        if ($user->can('view personal info') && (Auth::id() == $id || $user->hasRole('Admin'))) {
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function edit($id)
    {
        /** @var \App\Models\User */
        $user = Auth::user(); 

        if ($user->can('edit user') && (Auth::id() == $id || $user->hasRole('Admin'))) {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\User */
        $user = Auth::user(); 

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $userToUpdate = User::findOrFail($id);

        if (Auth::id() == $id || $user->hasRole('Admin')) {
            $userToUpdate->update($request->only('name', 'email'));
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function destroy($id)
    {
        /** @var \App\Models\User */
        $user = Auth::user(); 


        if ($user->hasRole('Admin') && Auth::id() != $id) {
            $userToDelete = User::findOrFail($id);
            $userToDelete->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')->with('error', 'Admins cannot delete themselves or unauthorized action.');
        }
    }
}
