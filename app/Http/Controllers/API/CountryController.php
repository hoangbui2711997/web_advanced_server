<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    //
	public function index() {
		return CountryResource::collection(Country::all());
	}

	public function show(Country $country) {
		return new CountryResource($country);
	}
}
