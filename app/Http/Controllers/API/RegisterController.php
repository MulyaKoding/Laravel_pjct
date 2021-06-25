<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Faceades\Auth;
use Validator;

class RegisterController extends BaseController {
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->falls()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Myapp')->accessToken;
        $success['name'] = $user->name;
        
        return $this->sendResponse($success, 'User Register Successfully');
    }


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')-> accessToken;
            $success['name'] = $user->name;
            
            return $this->sendResponse($success,'User Login successfully');

        }
        else{
            return $this->sendError('Unauthorized.', ['error'=>'Unauthorized']);
        }
    }
}