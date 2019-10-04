<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Notifications\SignupActivate;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Auth;
//use Request;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => Str::random(60)
        ]);
        $user->save();

//        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
//        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
        $user->notify(new SignupActivate());
        return response()->json([
            'data' => [
				'message' => 'Successfully created user!'
			]
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse [string] access_token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
//        $credentials['password'] = Hash::make(data_get($credentials, 'password'));
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
		Log::warning($credentials);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expired_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     * @param Request $request
     *
     * @return  ResponseFactory::json user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function users(Request $request)
    {
        list('page' => $page, 'limit' => $limit) = $request->only(['page', 'limit']);
        return response()->json(User::paginate($limit));
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }

	public function updateUser(Request $request)
	{
		try {
			$request->validate([
				'email' => 'required|string|email',
				'password' => 'required|string'
//				'remember_me' => 'boolean'
			]);

			User::find($request->input('id'))->update([
				'email' => $request->email,
				'password' => bcrypt($request->password),
				'name' => $request->name
			]);

			return [ 'message' => 'update succeed'];
		} catch (\Exception $ex) {
			Log::info($ex);
			throw $ex;
		}
	}

	public function delUser(Request $request) {
		try {
			$id = $request->input('user_id');
			User::destroy($id);
			return ['message' => 'delete succeeded'];
		} catch (\Exception $ex) {
			Log::info($ex);
			throw $ex;
		}
	}
}
