<?php

namespace App\Http\Controllers\API;

use App\Card\Cart;
use App\Http\Requests\CartStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth:api']);
	}

	public function store(CartStoreRequest $request, Cart $cart)
	{
		$cart->add($request->products);
	}
}
