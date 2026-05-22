<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Placeholder for the resource index action; intentionally left unimplemented.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user with the provided email and password and redirect based on the result.
     *
     * @param  StoreSessionRequest  $request  Validated request containing `email` and `password`.
     * @return RedirectResponse A redirect response to the previous page with an error and preserved input when authentication fails, or to `/` with a `success` flash message when authentication succeeds.
     */
    public function store(StoreSessionRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['password' => 'We were unable to authenticate using the provided credentials'])->withInput();
        }

        $request->session()->regenerate();

        return redirect('/')->with('success', 'You are logged in!');
    }

    /**
     * Log the current user out and redirect to the application root with a success message.
     *
     * @return RedirectResponse A redirect response to `'/'` with a `success` flash message of "You are logged out!".
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You are logged out!');
    }
}
