<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $rules = [
            'name' => 'required|unique:users,name',
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'name.required' => 'Isi Username Anda',
            'email.required' => 'Isi Email Anda',
            'password.required' => 'Isi Password Anda',

            'email' => 'Email harus di isikan dengan email valid',
            'unique' => 'Username sudah di gunakan',
        ];

        $request->validate($rules,$messages);

        $guest = new User;
        $guest->name = $request->input('name');
        $guest->email = $request->input('email');
        $guest->uuid = Uuid::uuid4()->getHex();
        $guest->password = \Hash::make($request->input('password'));
        $guest->save();
        return response($guest);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!\Auth::attempt($credentials)) {
            return response([
                'error' => null
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = \Auth::user();
        $jwt = $user->createToken($request->email)->plainTextToken;

        return response([
            'token' => $jwt
            // 'user' => $user
        ]);
    }
    
    public function get()
    {
        $user = \Auth::user();
        return $user;
    }

    public function detail($id)
    {
        $guest = User::where('id', $id)->get();
        return $guest;
    }
}
