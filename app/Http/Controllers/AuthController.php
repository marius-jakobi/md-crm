<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('welcome'))
                ->with('success', 'Login OK');
        } else {
            return redirect()->route('auth.login')
                ->with('error', 'Die Zugangsdaten sind nicht gültig.')
                ->withInput();
        }
    }

    public function logout() {
        Auth::logout();

        return redirect(route('welcome'))->with('success', 'Sie wurden abgemeldet.');
    }

    public function showSignupForm() {
        return view('auth.signup');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->input(), [
            'email' => 'required|email|unique:users,email',
            'firstname' => 'required|between:2,255',
            'lastname' => 'required|between:2,255',
            'password' => 'required|between:8,255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('auth.signup')
                ->withErrors($validator)
                ->withInput();
        }

        $newUser = new User($request->input());
        $newUser->password = Hash::make($request->input('password'));
        $newUser->save();

        return redirect()->route('welcome')->with('success', 'Ihre Registrierung wurde erfolgreich abgeschlossen.');
    }
}
