<?php

namespace App\Models;

use App\Custom\CustomModel;

class PasswordReset extends CustomModel
{
	//
	protected $fillable = [
		'email', 'token'
	];
}
