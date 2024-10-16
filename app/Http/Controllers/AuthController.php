<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
// use App\Enum\TokenAbility;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // dump($request->all());
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            // $access_token = $user->createToken('API TOKEN')->plainTextToken;
            $access_token = $user->createToken('access_token');
            //$refresh_token = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], config('sanctum.rt_expiration'));
            return response()->json([
                'token' => $access_token->plainTextToken,
                // 'refresh_token' => $refresh_token->plainTextToken,
                'user' => $user,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function register(Request $request)
    {
        // dd(13);
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function refresh_token(Request $request){
        $accessToken = $request->user()->createToken('access_token', [TokenAbility::ACCESS_API->value], config('sanctum.expiration'));

        return ['token' => $accessToken->plainTextToken];
    }
}
