<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller


{
    public function resetPassword(Request $request) {

        $validator = \Validator::make($request->all(), [
            'code' => 'required|exists:reset_code_passwords',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        // find the code
        $passwordReset = ResetCodePassword::query()->firstWhere('code', $request->code);

        // find user's email
        $user = User::query()->firstWhere('email', $passwordReset->email);

        // update user password
        $data = $request->all();
        $user->update(['password' => Hash::make($data['password'])]);

        // delete current code
        $passwordReset->delete();
        return response(['message' =>'password has been successfully reset'], 200);
    }
}
