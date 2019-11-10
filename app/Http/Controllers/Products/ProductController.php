<?php

namespace App\Http\Controllers\Products;

use App\Consts;
use App\Http\Resources\ProductIndexResource;
use App\Models\Cart;
use App\Models\DetailProductInCart;
use App\Models\Product;
use App\Models\ProductInCart;
use App\Models\ZipCode;
use App\Scoping\Scopes\CategoryScope;
use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
		try {
			DB::beginTransaction();
			$params = $request->all();
			$user = $request->user();
			$productIncart = new ProductInCart();
			$productIncart->cart_id = $user->cart()->first()->id;
			$productIncart->total = 0;

			$productIncart->save();

			$insertData = [];
			foreach (array_keys($params) as $table) {
				$val = $params[$table];
				if (is_array($val)) {
					foreach ($val as $id) {
						$insertData[] = [
							'product_in_cart_id' => $productIncart->id,
							'detail_morph_id' => $id,
							'detail_morph_type' => $table,
							'decoration_field' => Consts::$DECORATIONS[$table],
						];
					}
				} else {
					$insertData[] = [
						'product_in_cart_id' => $productIncart->id,
						'detail_morph_id' => $val,
						'detail_morph_type' => $table,
						'decoration_field' => Consts::$DECORATIONS[$table],
					];
				}
			}
			DetailProductInCart::insert($insertData);
			Log::warning('inserted');
			DB::commit();
		} catch (\Exception $e) {
			DB::rollBack();
			Log::info($e);
			throw $e;
		}
	}

	public function getCartInfo(Request $request)
	{
		return $request->user()->cart()->first();
	}

	public function removeProductInCart(Request $request)
	{
		$product = ProductInCart::find($request->input('product_id'));
		if ($product !== null) {
			DetailProductInCart::where('product_in_cart_id', $product->id)->delete();
			$product->delete();
		}
		return 'ok';
	}
}
