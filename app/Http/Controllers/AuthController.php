<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */

    public function index()
    {
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Extract the role (first letter) and number (remaining digits) from the username
        $role = substr($credentials['username'], 0, 1);
        $number = substr($credentials['username'], 1);

        // Validate the number format
        if (!is_numeric($number) || strlen($number) !== 8) {
            return back()->withErrors([
                'username' => 'The username format is invalid. Please enter Role (1 letter) + Number (8 digits).',
            ])->onlyInput('username');
        }

        // Attempt to authenticate using the role, number, and password
        if (Auth::attempt(['role' => $role, 'number' => $number, 'password' => $credentials['password']])) {
            // Regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            // Redirect the user to the intended home route
            return redirect()->intended('home');
        }

        // If authentication fails, return an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect('/');
    }

}
