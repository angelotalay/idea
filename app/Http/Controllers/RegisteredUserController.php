<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create(){
        return view("auth.register");
    }

    public function store(StoreUserRequest $request){
        // Validate request - done through the request class
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route("home")->with("success", "Account created successfully!");

    }
}
