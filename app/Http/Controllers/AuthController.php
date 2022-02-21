<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthCOntroller extends Controller {
    /**signin**/
    public function signin(Request $request) {
        $data = [
            'email' => $request->email,
            'password'=>$request->password
        ];

        if (auth()->attemt($data)) {
            $token = auth()->createToken('LaravelPassportRestApiExample')->accessToken;
            return response()->json(['token'=>$token],200);
        } else {
            return response()->json(['error'=>'Unauthorised'],401);
        }
    }

    public function signup(Request $request) {
        $this->validate($request, [
            'name'=>'required|email',
            'password'=>'required|min:4',
        ]);

        $user = User::create([
            'name'=>$request->email,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelPassportRestApiExampl')->accessToken;

        return response()->json(['token'=>$token],200);
    }
}