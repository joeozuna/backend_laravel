<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public  $loginAfterSignUp = true;

    public  function register(Request  $request) {
        $user = new  User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return  $this->login($request);
        }
        return  response()->json([
            'status' => 'ok',
            'data' => $user,
            'error_msg' => 'Registro correcto',
        ], 200);
        
    }

    public  function  login(Request  $request) {
        $input = $request->only('email', 'password');
        $jwt_token = null;
        
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return  response()->json([
                'status' => 'error',
                'error_msg' => 'Email or Password Invalid.',
            ], 200);
        }
        return  response()->json([
            'status' => 'ok',
            'token' => $jwt_token,
        ]);
    }

    public  function  logout(Request  $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);
            return  response()->json([
                'status' => 'ok',
                'message' => 'Cierre de sesión exitoso.'
            ]);
        } catch (JWTException  $exception) {
            return  response()->json([
                'status' => 'unknown_error',
                'message' => 'Al usuario no se le pudo cerrar la sesión.'
            ], 500);
        }
    }

    public  function  getAuthUser(Request  $request) {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);
        return  response()->json(['user' => $user]);
    }
}
