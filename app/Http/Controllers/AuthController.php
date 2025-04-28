<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // Mail::to('recipient@example.com')->send(new WelcomeEmail());
        // return "Email sent successfully!";
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        Mail::to('hello@example.com')->send(new WelcomeEmail());

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('Token', $token, 2); // 1 day

        return response([
            'message' => $token,
            'status' => 'Email Sended'
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }

    public function sendWelcomeEmail()
    {
        Mail::to('hello@example.com')->send(new WelcomeEmail());
        return response([
            'message' => 'Email Sended'
        ]);
    }
}
