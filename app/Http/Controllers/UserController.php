<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $users->map(function ($item) {
            return $item->makeHidden(["role_id"])->role;
        });

        return $users;
    }

    public function logout(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return true;
    }

    public function updateUserAuth(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|regex:/^[0-9]{11}$/',
        ]);

        return Auth::user()->update($request->all());
    }

    public function getInfoUserAuth(Request $request) {
        $user = Auth::user();
        $user->makeHidden(["role_id"])->role;
        return $user;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->api_token = Str::random(60);
            $user->save();
            return $user;
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|regex:/^[0-9]{11}$/',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
