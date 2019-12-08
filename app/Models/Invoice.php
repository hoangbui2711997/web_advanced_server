<?php

namespace App\Models;

use App\Custom\CustomModel;

class Invoice extends CustomModel
{
	//
	protected $fillable = [
		'service_fee',
		'amount',
		'status',
		'delivery_date',
		'instruction',
		'address_book_id',
		'note_id',
	];
}
