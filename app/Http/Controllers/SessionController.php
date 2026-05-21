<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'You are logged out!');
    }
}
