<?php

namespace App\Http\Controllers\API;

use App\Models\CollectionFlower;
use App\Models\Product;
use App\Models\ProductCollectionFlower;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
	public function getCollectionProduct()
	{
		$collections = CollectionFlower::orderBy('created_at')->limit(5)->get();

		$collections->each(function ($collection) {
			$collection->products = Product::join('product_collection_flowers', 'product_id', 'products.id')
				->join('discounts', 'discount_id', 'discounts.id')
				->where('collection_flower_id', $collection->id)
				->limit(5)
				->select('products.*', 'discounts.percent')
				->orderBy('created_at')
				->get();
		});
		return $collections;
	}
}
