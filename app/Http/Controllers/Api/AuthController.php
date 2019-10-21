<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{
    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'data' =>  $validator->errors(),
                'status' => 'error',
                'code' => 422
            ]);
        }

        $validateData = request()->only('email' , 'password');

        if(auth()->validate($validateData)) {

            auth()->attempt($validateData);
            auth()->user()->update([
                'api_token' => Str::random(60)
            ]);
            
            return response([
                'data' => [
                    'user_id' => auth()->id(),
                    'api_token' => auth()->user()->api_token
                ],
                'status' => 'success',
                'code' => 200
            ]);
        } else {
            return response([
                'data' => 'اطلاعات شما با هم مطابقت ندارد',
                'status' => 'error',
                'code' => 302
            ]);
        }
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response([
                'data' =>  $validator->errors(),
                'status' => 'error',
                'code' => 422
            ]);
        }

        $user = User::create([
            'name' => explode('@',request('email'))[0],
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'api_token' => Str::random(60)
        ]);

        return response([
            'data' => $user,
            'status' => 'error',
            'code' => 200
        ]);


    }
}
