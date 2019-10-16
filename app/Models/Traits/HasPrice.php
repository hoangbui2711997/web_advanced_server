<?php


namespace App\Models\Traits;

use App\Card\Money;

trait HasPrice
{
	public function getPriceAttribute($value) : Money
	{
		return new Money($value);
	}

	public function getFormattedPriceAttribute() : string
	{
		return $this->price->formattedPrice();
	}
}
