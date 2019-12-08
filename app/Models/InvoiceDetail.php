<?php

namespace App\Models;

use App\Custom\CustomModel;

class InvoiceDetail extends CustomModel
{
	//
	protected $fillable = [
		'amount',
		'product_in_cart_id',
		'invoice_id',
	];
}
