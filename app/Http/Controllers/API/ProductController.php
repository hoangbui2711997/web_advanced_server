<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use App\Models\ZipCode;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	private $productService;

	public function __construct(ProductService $productService)
	{
		$this->productService = $productService;
	}

	public function index(Request $request)
	{
		return $this->productService->getProducts($request);
	}

	public function getProduct($slug)
	{
		return $this->productService->getProduct($slug);
	}

	public function getZipcode($id)
	{
		return ZipCode::find($id);
	}
}
