<?php


namespace App\Card;


use App\Models\User;

class Cart
{
	private $user;
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function add(array $products)
	{
		$this->user->cart()->syncWithoutDetaching([
			$this->getStorePayload($products)
		]);
	}

	/**
	 * @param array $products
	 * @return array
	 */
	public function getStorePayload(array $products): array
	{
		$products = collect($products)->keyBy('id')->map(function ($product) {
			return [
				'quantity' => $product['quantity']
			];
		})->toArray();
		return $products;
	}
}
