<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class CodeCheckController extends Controller
{
    public function checkCode(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required|exists:reset_code_passwords',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // find the code
        $passwordReset = ResetCodePassword::query()->firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }
        return response(['message' =>'Code confirmed'], 200);
    }
}
