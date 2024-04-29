<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $incomingFields = $request->validate(
            [
                "username" => [
                    "required",
                    "min:3",
                    "max:20",
                    //(Table name, column name)
                    Rule::unique('users', 'username')
                ],
                "email" => ["required","email",Rule::unique("users","email")],
                //Html file inpunt name need to be pizza and pizza_confirmation
                "password" => ["required","min:3","confirmed"]
            ]
        );
        User::create($incomingFields);
        return "Hello from the register...";
    }
}
