<?php


namespace App\Http\Services;


use App\Consts;
use App\Models\Cart;
use App\Models\DetailProductInCart;
use App\Models\ProductInCart;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserService
{
	public function addToCart(Request $request): void
	{
		try {
			DB::beginTransaction();
			$params = $request->all();
			$user = $request->user();
			$productIncart = new ProductInCart();
			$productIncart->cart_id = $user->cart()->first()->id;
			$productIncart->total = 0;

			$productIncart->save();

			$insertData = [];
			foreach (array_keys($params) as $table) {
				$val = $params[$table];
				if (is_array($val)) {
					foreach ($val as $id) {
						$insertData[] = [
							'product_in_cart_id' => $productIncart->id,
							'detail_morph_id' => $id,
							'detail_morph_type' => $table,
							'decoration_field' => Consts::$DECORATIONS[$table],
						];
					}
				} else {
					$insertData[] = [
						'product_in_cart_id' => $productIncart->id,
						'detail_morph_id' => $val,
						'detail_morph_type' => $table,
						'decoration_field' => Consts::$DECORATIONS[$table],
					];
				}
			}
			DetailProductInCart::insert($insertData);
			Log::warning('inserted');
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
			throw $e;
		}
	}

	public function getCartInfo(Request $request)
	{
		return $request->user()->cart()->first();
	}

	public function removeProductInCart(Request $request): string
	{
		$product = ProductInCart::find($request->input('product_id'));
		if ($product !== null) {
			DetailProductInCart::where('product_in_cart_id', $product->id)->delete();
			$product->delete();
		}
		return 'ok';
	}

	public function signup(Request $request): ?\Illuminate\Http\JsonResponse
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
			'activation_token' => Str::random(60),
		]);
		try {
			DB::beginTransaction();
			$user->save();
			$userRole = new UserRole([
				'user_id' => $user->id,
				'role_id' => Consts::$ROLE_USER
			]);
			$userRole->save();
			$cart = new Cart(['user_id' => $user->id, 'total' => 0]);
			$cart->save();
//        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
//        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
			$user->notify(new SignupActivate());
			DB::commit();
			return response()->json([
				'data' => [
					'message' => 'Successfully created user!'
				]
			], 201);
		} catch (\Exception $exception) {
			Log::error($exception);
			DB::rollBack();
			throw $exception;
		}
	}

	public function login(Request $request): \Illuminate\Http\JsonResponse
	{
		$request->validate([
			'email' => 'required|string|email',
			'password' => 'required|string',
			'remember_me' => 'boolean'
		]);
		$credentials = request(['email', 'password']);
//        $credentials['password'] = Hash::make(data_get($credentials, 'password'));
//        $credentials['active'] = 1;

		$user = User::where('email', $request->input('email'))->first();
		if($user === null || !$user->isUser() || !Auth::attempt($credentials))
			return response()->json([
				'message' => 'Unauthorized'
			], 401);
		$user = $request->user();
		$tokenResult = $user->createToken('Personal Access Token');
		$token = $tokenResult->token;
		if ($request->remember_me)
			$token->expires_at = Carbon::now()->addWeeks(1)->format('Y-m-d H:i:m.u');
		$token->save();
		return response()->json([
			'access_token' => $tokenResult->accessToken,
			'token_type' => 'Bearer',
			'expired_at' => Carbon::parse(
				$tokenResult->token->expires_at
			)->toDateTimeString()
		]);
	}

	public function logout(Request $request): \Illuminate\Http\JsonResponse
	{
		$request->user()->token()->revoke();
		return response()->json([
			'message' => 'Successfully logged out'
		]);
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

	public function updateUser(Request $request): ?array
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

	public function updateUserInfo(Request $request)
	{
		return null;
	}
}
