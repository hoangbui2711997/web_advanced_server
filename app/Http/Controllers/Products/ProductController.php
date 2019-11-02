<?php

namespace App\Http\Controllers\Products;

use App\Http\Resources\ProductIndexResource;
use App\Models\Product;
use App\Models\ZipCode;
use App\Scoping\Scopes\CategoryScope;
use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	private $productService;

	public function __construct(ProductService $productService)
	{
		$this->productService = $productService;
	}

	public function index(): array
	{
        $products = Product::paginate(10);
        return ProductIndexResource::collection($products)->toArray(request());
    }

    public function show($product)
    {
//		Log::warning('@show');
//		Log::warning($product);
//		if ($_SESSION[request()->getRequestUri()] == 5) {
//			\Cache::store('redis')->put(sha1(request()->getUri()), Product::findOrFail($product));
//			return \Cache::store('redis')->get(sha1(request()->getUri()), Product::findOrFail($product));
//		} elseif ($_SESSION[request()->getRequestUri()] > 5) {
//			return \Cache::store('redis')->get(sha1(request()->getUri()), Product::findOrFail($product));
//		} else {
			return Product::with(['category', 'discount', 'variations', 'productExtras'])->findOrFail($product);
//		}
//        return (new ProductResource(
//			$product
//		))->toArray(request());
    }

	public function getZipcode($id)
	{
		return ZipCode::find($id);
	}

	/**
	 * return associate array;
	 * key for field query
	 * value for scope defined
	 * @return array
	 */
	private function scopes()
	{
		return [
			'category' => new CategoryScope()
		];
	}

	public function addToCart(Request $request)
	{
		$params = $request->all();

	}
}
