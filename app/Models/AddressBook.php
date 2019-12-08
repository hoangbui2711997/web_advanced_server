<?php

namespace App\Models;

use App\Custom\CustomModel;

class AddressBook extends CustomModel
{
	//
	protected $fillable = [
		'first_name',
		'last_name',
		'address_line_1',
		'address_line_2',
		'phone_number',
		'email',
		'location_type_id',
		'zipcode_id',
		'user_id',
		'city',
		'province',
	];
}
