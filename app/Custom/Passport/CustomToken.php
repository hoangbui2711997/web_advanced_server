<?php


namespace App\Custom\Passport;


use Laravel\Passport\Token;

class CustomToken extends Token
{
	protected $dateFormat = 'Y-m-d H:i:s';
}
