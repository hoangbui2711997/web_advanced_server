<?php

namespace App\Models;

use App\Custom\CustomModel;

class UserConversation extends CustomModel
{
    //
	protected $fillable = [
		'user_id',
		'message'
	];
}
