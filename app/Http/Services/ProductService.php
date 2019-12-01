<?php


namespace App\Http\Services;


use App\Consts;
use App\Http\Resources\ProductIndexResource;
use App\Models\Product;

class ProductService
{

	public function getProducts(\Illuminate\Http\Request $request)
	{
		return Product::paginate($request->input('limit', Consts::$PER_PAGE));
//		$products = Product::paginate(10);
//		return ProductIndexResource::collection($products)->toArray(request());
	}

	public function getProduct($slug)
	{
		//		Log::warning('@show');
//		Log::warning($product);
//		if ($_SESSION[request()->getRequestUri()] == 5) {
//			\Cache::store('redis')->put(sha1(request()->getUri()), Product::findOrFail($product));
//			return \Cache::store('redis')->get(sha1(request()->getUri()), Product::findOrFail($product));
//		} elseif ($_SESSION[request()->getRequestUri()] > 5) {
//			return \Cache::store('redis')->get(sha1(request()->getUri()), Product::findOrFail($product));
//		} else {
		return Product::with(['category', 'discount', 'variations', 'productExtras'])->where('slug', $slug)->firstOrFail();
//		}
//        return (new ProductResource(
//			$product
//		))->toArray(request());
	}
}
