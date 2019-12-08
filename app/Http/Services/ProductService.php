<?php


namespace App\Http\Services;


use App\Consts;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{

	public function getProducts(\Illuminate\Http\Request $request)
	{
		return Product::join('discounts', 'discount_id', 'discounts.id')
			->select('products.*', 'discounts.percent')
			->orderBy('products.special_to', 'desc')
			->paginate($request->input('limit', Consts::$PER_PAGE));
	}

	public function getProduct($slug)
	{
		return Product::with(['category', 'discount', 'variations', 'productExtras'])
			->where('slug', $slug)->firstOrFail();
	}
}
