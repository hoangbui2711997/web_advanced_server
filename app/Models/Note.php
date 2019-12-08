<?php

namespace App\Models;

use App\Custom\CustomModel;

class Note extends CustomModel
{
	//
	protected $fillable = [
		'from_message',
		'message',
		'type_id',
	];
}
