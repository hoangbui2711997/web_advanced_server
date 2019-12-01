<?php


namespace App\Custom\Passport;


use Laravel\Passport\Token;

class CustomToken extends Token
{
	protected $dateFormat = 'Y-m-d H:i:s.u';

	public function fromDateTime($value)
	{
		return empty($value) ? $value :
			substr(
				$this->asDateTime($value)->format(
					$this->getDateFormat()
				),
				0,
				(strlen($this->asDateTime($value)->format(
						$this->getDateFormat()
					)) - 3));
	}
}
