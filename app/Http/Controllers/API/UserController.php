<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
	private $userService;

    public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

	public function addToCart(Request $request)
	{
		$this->userService->addToCart($request);
	}

	public function getCartInfo(Request $request)
	{
		return $this->userService->getCartInfo($request);
	}

	public function removeProductInCart(Request $request)
	{
		return $this->userService->removeProductInCart($request);
	}

	public function signup(Request $request)
	{
		try {
			return $this->userService->signup($request);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Login user and create token
	 */
	public function login(Request $request)
	{
		try {
			DB::beginTransaction();
			return $this->userService->login($request);
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
		}
	}

	/**
	 * Logout user (Revoke the token)
	 *
	 * @param Request $request
	 * @return JsonResponse [string] message
	 */
	public function logout(Request $request): JsonResponse
	{
		return $this->userService->logout($request);
	}

	/**
	 * Get the authenticated User
	 * @param Request $request
	 *
	 * @return  ResponseFactory::json user object
	 */
	public function user(Request $request): ResponseFactory
	{
		return response()->json($request->user());
	}

	public function signupActivate($token)
	{
		return $this->userService->signupActivate($token);
	}

	public function updateUser(Request $request): ?array
	{
		try {
			return $this->userService->updateUser($request);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function updateUserInfo(Request $request)
	{
		try {
			return $this->userService->updateUserInfo($request);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function addAddressBook(Request $request)
	{
		try {
			$this->userService->addAddressBook($request);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function getAddressBooks()
	{
		try {
			return $this->userService->getAddressBooks();
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function paymentCart()
	{
		return $this->userService->paymentCart();
	}

	public function getCurrentUser()
	{
		$user = \Auth::user();
		$user->conversation;
		return $user;
	}
}
