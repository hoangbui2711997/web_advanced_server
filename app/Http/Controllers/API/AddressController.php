<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    //
	public function index() {
		return AddressResource::collection(Address::all());
	}

	public function show(Address $address)
	{
		return new AddressResource($address);
	}
}
