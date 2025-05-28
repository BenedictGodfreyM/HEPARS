<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'firstname.required' => 'Please enter your firstname.',
            'firstname.string' => 'Your firstname should be in words.',
            'firstname.max' => 'Your firstname is too long.',
            'surname.required' => 'Please enter your surname.',
            'surname.string' => 'Your surname should be in words.',
            'surname.max' => 'Your surname is too long.',
            'email.required' => 'Please enter your E-Mail address.',
            'email.string' => 'Your E-Mail should be in worlds.',
            'email.lowercase' => 'Your E-Mail should consist of lowercase letters only.',
            'email.email' => 'Please provide a valid E-Mail address.',
            'email.max' => 'Your E-Mail is too long.',
            'email.unique' => 'The E-Mail you provided has already been used.',
            'password.required' => 'Please enter your password.',
            'password.letters' => 'Your password must include at least one letter.',
            'password.numbers' => 'Your password must include at least one number.',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
