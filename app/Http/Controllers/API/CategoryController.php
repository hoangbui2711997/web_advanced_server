<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::parents()->ordered()->get()
        );
    }

	public function show(Product $product)
	{
		return new ProductResource(
			$product
		);
	}
}
