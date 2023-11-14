<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => error_processor($validator)], 403);
        }

        $user_id = $request['username'];
        $medium = filter_var($user_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $data = [
            $medium => $user_id,
            'password' => $request->password,
        ];

        $user = User::where([$medium => $user_id])->first();

        if (isset($user)) {

            if ($user->status && auth()->attempt($data)) {
                $token = auth()->user()->createToken('LaravelAuthApp')->plainTextToken;

                $user->updated_at = now();
                $user->save();

                return response()->json(['token' => $token, 'user' => $user, 'success' => true], 200);
            } else {
                $errors = [];
                array_push($errors, ['code' => 'auth-001', 'message' => 'credentials do not match or account has been suspended']);
                return response()->json([
                    'errors' => $errors,
                    'success' => false
                ]);
            }
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => 'credentials do not match or account has been suspended']);
            return response()->json([
                'errors' => $errors,
                'success' => false
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
}
