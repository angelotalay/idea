<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the user registration form.
     *
     * @return View The registration view for creating a new account.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Create a new user from validated input, authenticate them, and redirect to the home page.
     *
     * @param  StoreUserRequest  $request  The validated request containing `name`, `email`, and `password`.
     * @return RedirectResponse Redirect to `'/'` with session flash key `success` set to `"Account created successfully!"`.
     */
    public function store(StoreUserRequest $request)
    {
        // Validate request - done through the request class
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully!');

    }
}
