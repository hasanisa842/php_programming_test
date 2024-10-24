<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginRegistrationForm()
    {
        return view('auth.auth');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'ktp' => 'required|numeric|digits:16|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|numeric|unique:users'
        ]);

        User::create([
            'name' => $request->name,
            'ktp' => $request->ktp,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
        ]);

        return redirect('/login-register')->with('success', 'Registration successful! You can now log in.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'ktp' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('ktp', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors([
            'ktp' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'password' => ['required', 'string', 'max: 14', 'confirmed'],
            'ktp' => ['required', 'numeric', 'min:16', 'max:16', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'ktp' => $data['ktp'],
            'phone_number' => $data['phone_number'],
        ]);
    }
}
