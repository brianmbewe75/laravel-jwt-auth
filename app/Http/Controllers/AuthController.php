<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
// use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //set a constructor first set a constructor api model middleware

public function _construct(){
            
     $this->middleware('auth:api', ['except' => ['login', 'register' ]]);

}

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|confirmed|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);

        } 
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' =>bcrypt($request->password)]
            
        ));

        return response()->json([
        'message' => 'Useer succesfylly registered',
        'user'=> $user
        ],201);

    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
       
            'email' => 'required|email',
            'password' => 'required|string|min:6'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(),422);
    
            } 
            if(!$token=auth()->attempt($validator->validated())){
                return response()->json(['error' => 'Unauthorized'], 401);

            }
            return $this->createNewToken($token);
    }

    public function createNewToken($token){
return response() ->json([
    'access_token'=>$token,
    'token_type'=> 'bearer',
    'expires_in' => JWTAuth::factory()->getTTL() * 24,
    'user'=>auth()->user()

    ]);
    }



    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();

        
        return response()->json([
            'message' => 'Useer logged out succesfylly'
    
            ]);
    }
}
