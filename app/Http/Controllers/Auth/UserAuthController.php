<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class UserAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ]);
        $data['password']= bcrypt($request->password);
        $user = User::create($data);
        $token = $user->createToken('API token')->accessToken;
        return response(['user'=>$user,'token',$token]);
    }
    public function login(Request $request)
    {
        //validate credentials
        $data = $request->validate([
            'email'=>'email|required',
            'password'=>'required',
        ]);
        //to check whether the user is authenticated or not
        if(!auth()->attempt($data))
        {
            return response(['error_message'=>'Incorrect details please try again']);

        }
        //to create token
        $token = auth()->user()->createToken('Api token')->accessToken;
        return response(['user'=>auth()->user(),'token'=>$token]);
    }
    public function logout(Request $request)
    {

        $token = $request->user()->token();
      
        if(!empty($token))
        {

            DB::table('oauth_access_tokens')->where('id',$token->id)->delete();

        }
       return $response =
        [
            'status'=> true,
            'message'=>__('Logged Out Successfully'),
            'data'=>null,
        ];
    }
}
