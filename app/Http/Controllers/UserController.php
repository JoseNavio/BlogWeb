<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate(
            [
                "username"=> "required",
                "email"=> "required",
                "password"=> "required"
            ]
        );
        return "Hello from the register...";
    }
}
