<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\OrderStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware(['auth:api']);
	}

	public function store(OrderStoreRequest $request)
	{

	}
}
