<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function Login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            $credentials = $request->only('email', 'password');
            try {
                // attempt to verify the credentials and create a token for the user
                if (! $token = JWTAuth::attempt($credentials)) {
                    return json_encode([
                        'code'=>'401',
                        'Msg'=>'invalid_credentials'
                    ]);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return json_encode([
                    'code'=>'500',
                    'Msg'=>'could_not_create_token'
                ]);
            }
            return json_encode([
                'code'=>'200',
                'Msg'=>$token
            ]);
        }
        else{
            return json_encode([
                'code'=>'401',
                'Msg'=>'invalid_loginfo'
            ]);
        }
    }
}
