<?php


namespace App\Card;


use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as BaseMoney;
use NumberFormatter;

class Money
{
	private $money;

	public function __construct($value)
	{
		$this->money = new BaseMoney($value, new Currency('GBP'));
	}

	public function formattedPrice()
	{
		$formatter = new IntlMoneyFormatter(
			new NumberFormatter('en_GB', NumberFormatter::CURRENCY),
			new ISOCurrencies()
		);

		return $formatter->format($this->money);
	}

	public function amount()
	{
		return $this->money->getAmount();
	}
}
