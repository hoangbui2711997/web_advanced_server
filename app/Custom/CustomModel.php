<?php


namespace App\Custom;


use Illuminate\Database\Eloquent\Model;

class CustomModel extends Model
{
	protected $dateFormat = 'Y-m-d H:i:m.u';

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
