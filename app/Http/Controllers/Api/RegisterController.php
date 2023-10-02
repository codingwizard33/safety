<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'print_name' => 'required',
            'sign_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'emergency_contact_name' => 'required',
            'company_name' => 'required',
            'password' => 'required',
//            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->sign_name;

        return $this->sendResponse($success, 'Your registration created successfully.');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if(! Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return $this->sendError('Unauthorised.', ['email' => ['Unauthorised']]);
        }

        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->sign_name;

        return $this->sendResponse('Success', 'User login successfully.');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return $this->sendResponse('Success', 'User logout successfully.');
    }
}