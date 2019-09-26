<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Str;
use Log;

class PasswordResetController extends Controller
{
    /**
     * @param string email
     * @return string message
     * @throws \Exception
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
            ]);

            $user = User::where('email', $request->email)->firstOrFail();
            $passwordReset = PasswordReset::updateOrCreate(['email' => $user->email], ['email' => $user->email, 'token' => Str::random(60)]);

            if ($user && $passwordReset) {
                $user->notify(new PasswordResetRequest($passwordReset->token));
            }

            return response()->json(['message' => 'We have e-mailed your password reset link!']);
        } catch (\Exception $e) {
            Log::info($e);
            throw $e;
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function find($token)
    {
        try {
            $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
            if (Carbon::parse($passwordReset->updated_at)->addMinute(60)->isPast()) {
                $passwordReset->delete();
                return response()->json([
                    'messsage' => 'This password reset token is invalid.'
                ], 404);
            }

            return response()->json($passwordReset);
        } catch (\Exception $exception) {
            Log::info($exception);
            throw $exception;
        }
    }

    public function reset(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|confirmed',
                'token' => 'required|string'
            ]);

            $passwordReset = PasswordReset::where([
                ['token', $request->token],
                ['email', $request->email]
            ])->firstOrFail();

            $user = User::where('email', $request->email)->firstOrFail();
            $user->password = bcrypt($request->password);

            $user->save();
            $passwordReset->delete();

            $user->notify(new PasswordResetSuccess());

            return response()->json($user);
        } catch (\Exception $exception) {
            Log::info($exception);
            return response()->json(['message' => $exception], 404);
        }
    }
}
