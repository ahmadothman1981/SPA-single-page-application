<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }
    public function store(Request $request)
    {
       
       $user= User::create($request->validate([
            'name' =>'required |string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:20,confirmed',
        ]));
        $user->save();
        Auth::login($user);
        return redirect()->route('listings.index')->with('success', 'Account Created');
    }
}
