<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function block($id)
    {
        $user = User::find($id);

        if ($user) {
            // Update the user's blocked status
            $user->blocked = true; // Make sure you have this column in your users table
            $user->save();

            return redirect()->back()->with('success', 'User has been blocked successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
}
