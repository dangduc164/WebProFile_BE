<?php

namespace App\Http\Controllers;

use App\Models\InformationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        $sql = User::where('email', $request->email)->first(['id', 'active']);

        if (!empty($sql) && $sql->active != User::USER_STATUS_ACTIVE) {
            return response()->json(['error' => 'account not active'], 403);
        }

        return $this->createToken($token);
    }



    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        // return response()->json(['message' => 'User successfully signed out']);

        // try {
        //     auth()->logout();
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'Logout failed: ' . $e->getMessage()], 500);
        // }

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     *  @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->createNewToken(auth()->refresh());
    // }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)],
            ['active' => 0],
            ['type' => 'admin']
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    protected function createToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => JWTAuth::user()
        ]);
    }

    public function changePassWord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = auth()->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'The current password is incorrect.']);
        }
        $userId = $user->id;
        $user = User::where('id', $userId)->update(
            ['password' => bcrypt($request->new_password)]
        );

        return response()->json([
            'message' => 'User successfully changed password',
            'user' => $user,
        ], 201);
    }


    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */
    // public function sendMail(Request $request)
    // {
    //     $user = User::where('email', $request->email)->firstOrFail();
    //     $passwordReset = PasswordReset::updateOrCreate([
    //         'email' => $user->email,
    //     ], [
    //         'token' => Str::random(60)
    //     ]);
    //     if ($passwordReset) {
    //         $user->notify(new ResetPasswordRequest($passwordReset->token));
    //     }

    //     return response()->json([
    //         'message' => 'We have e-mailed your password reset link!'
    //     ]);
    // }

    // public function reset(Request $request, $token)
    // {
    //     $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
    //     if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
    //         $passwordReset->delete();

    //         return response()->json([
    //             'message' => 'This password reset token is invalid.',
    //         ], 422);
    //     }
    //     $user = User::where('email', $passwordReset->email)->firstOrFail();
    //     $updatePasswordUser = $user->update($request->only('password'));
    //     $passwordReset->delete();

    //     return response()->json([
    //         'success' => $updatePasswordUser,
    //     ]);
    // }
}
