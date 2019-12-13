<?php


namespace App\Http\Services;


use App\Consts;
use App\Models\AddressBook;
use App\Models\Cart;
use App\Models\Conversation;
use App\Models\DetailProductInCart;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Note;
use App\Models\Product;
use App\Models\ProductExtraVariation;
use App\Models\ProductInCart;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Vase;
use App\Models\VaseVariation;
use App\Notifications\SignupActivate;
use Brick\Math\BigDecimal;
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
			$conversation = new Conversation([
				'user_id' => $user->id
			]);
			$conversation->save();
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

	public function login(Request $request)
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
		if($user === null || !$user->isUser() || !Auth::guard('web')->attempt($credentials))
			return response()->json([
				'message' => 'Unauthorized'
			], 401);

		$tokenResult = $user->createToken('Personal Access Token');
		$token = $tokenResult->token;
		if ($request->remember_me)
			$token->expires_at = Carbon::now()->addWeeks(1)->format('Y-m-d H:i:m.u');
		$token->save();

		Conversation::where('user_id', $user->id)->update(['active' => true]);

		DB::commit();
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
		try {
			DB::beginTransaction();
			$request->user()->token()->revoke();
			Conversation::where('user_id', Auth::id())->update(['active' => false]);
			DB::commit();
			return response()->json([
				'message' => 'Successfully logged out'
			]);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
		}
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

	public function addAddressBook(Request $request)
	{
		Log::warning($request->all());
		$user = Auth::user();
		$userId = data_get($user, 'id', '');
		list(
			// address books
			'first_name' => $firstName,
			'last_name' => $lastName,
			'address_line_1' => $addressLine1,
			'address_line_2' => $addressLine2,
			'phone_number' => $phone_number,
			'email' => $email,
			'location' => $location,
			'zipcode_id' => $code,
			'city' => $city,
			'province' => $province,
			// deliver_infos
			'delivery_date' => $delivery_date,
			'instruction' => $instruction,
			// notes
			'from_message' => $from_message,
			'message' => $message,
			'note_type' => $note_type,
		) = $request->all();

		$addressBook = [
			'first_name' => $firstName,
			'last_name' => $lastName,
			'address_line_1' => $addressLine1,
			'address_line_2' => $addressLine2,
			'phone_number' => $phone_number,
			'email' => $email,
			'location_type_id' => $location['id'],
			'zipcode_id' => $code,
			'user_id' => Auth::id(),
			'city' => $city,
			'province' => $province
		];
		try {
			DB::beginTransaction();
			$addressBook = AddressBook::updateOrCreate(
				$addressBook
			);
			$note = Note::create([
				'from_message' => $from_message,
				'message' => $message,
				'type_id' => $note_type['id'],
			]);
			$total = $this->makeInvoice($userId, [
				'delivery_date' => $delivery_date,
				'instruction' => $instruction,
				'address_book_id' => $addressBook['id'],
				'note_id' => $note['id']
			]);
			$this->makeCartEmpty($userId);

			$user->balance = BigDecimal::of((float) $user->balance)->minus($total)->jsonSerialize();
			$user->save();
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
			throw $e;
		}
	}

	public function paymentCart()
	{
		$cart = Cart::where('user_id', Auth::id())->first();
		$total = BigDecimal::zero();

		foreach ($cart->products as $product) {
			foreach ($product->details as $detail) {
				$id = $detail->detail_morph_id;
				switch ($detail->detail_morph_type) {
					case Consts::$MORPH_PRODUCTS:
						$detailMorth = Product::find($id);
						break;
					case Consts::$MORPH_PRODUCT_VARIATIONS:
						$detailMorth = ProductVariation::find($id);
						break;
					case Consts::$MORPH_PRODUCT_EXTRA_VARIATIONS:
						$detailMorth = ProductExtraVariation::find($id);
						break;
					case Consts::$MORPH_VASES:
						$detailMorth = Vase::find($id);
						break;
					case Consts::$MORPH_VASE_VARIATIONS:
						$detailMorth = VaseVariation::find($id);
						break;
				}
				$total = $total->plus(BigDecimal::of((float) $detailMorth->price));
			}
		}

		return $total->jsonSerialize();
	}

	private function makeInvoice($id, $params)
	{
		try {
			$cart = Cart::where('user_id', $id)->first();
			$totalWithoutFee = $this->paymentCart();
			$serviceFee = BigDecimal::of(random_int(0, 10));
			$total = BigDecimal::of($totalWithoutFee)->minus($serviceFee);

			$invoice = Invoice::create(array_merge(
				['amount' => $total, 'status' => Consts::$INVOICE_STATUS_NEED_PAY, 'service_fee' => $serviceFee],
				$params
			));

			foreach ($cart->products as $product) {
				$productTotal = BigDecimal::zero();
				foreach ($product->details as $detail) {
					$id = $detail->detail_morph_id;
					switch ($detail->detail_morph_type) {
						case Consts::$MORPH_PRODUCTS:
							$detailMorth = Product::find($id);
							break;
						case Consts::$MORPH_PRODUCT_VARIATIONS:
							$detailMorth = ProductVariation::find($id);
							break;
						case Consts::$MORPH_PRODUCT_EXTRA_VARIATIONS:
							$detailMorth = ProductExtraVariation::find($id);
							break;
						case Consts::$MORPH_VASES:
							$detailMorth = Vase::find($id);
							break;
						case Consts::$MORPH_VASE_VARIATIONS:
							$detailMorth = VaseVariation::find($id);
							break;
					}
					$productTotal = $productTotal->plus(BigDecimal::of((float) $detailMorth->price));
				}
				InvoiceDetail::create([
					'amount' => $productTotal->jsonSerialize(),
					'product_in_cart_id' => $product->id,
					'invoice_id' => $invoice->id
				]);
			}

			return $total;
		} catch (\Exception $e) {
			Log::info($e);
			throw $e;
		}
	}

	private function makeCartEmpty($userId): void
	{
		$cart = Cart::where('user_id', $userId)->first();
		$products = ProductInCart::where('cart_id', $cart->id)->get();
		$products->each(function ($product) {
			$product->cart_id = null;
			$product->save();
		});
//		$cart->delete();
	}

	public function getAddressBooks()
	{
		return AddressBook::all();
	}
}
