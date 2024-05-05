<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(User $user)
    {

        return view('profile-posts', [ 
            'username' => $user->username,
            'posts' => $user->posts()->latest()->get() //Latest order them...
        ]);
    }
}
