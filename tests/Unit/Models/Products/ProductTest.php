<?php

namespace Tests\Unit\Models\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    public function test_it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product();
        $this->assertEquals($product->getRouteKeyName(), 'slug');
//        $this->assertTrue(true);
    }

	public function test_it_has_many_categories()
	{
		$product = factory(Product::class)->create();
		$product->categories()->save(
			factory(Category::class)->create()
		);

		$this->assertInstanceOf(Category::class, $product->categories->first());
	}

	public function test_it_has_many_variations()
	{
		$product = factory(Product::class)->create();
		$product->variations()->save(
			factory(ProductVariation::class)->create()
		);

		$this->assertInstanceOf(ProductVariation::class, $product->variations->first());
	}

	public function test_it_returns_a_money_instance_for_the_price()
	{
		$product = factory(Product::class)->create(
			['price' => 1000]
		);

		echo $product->formattedPrice;
		$this->assertInstanceOf(Money::class, $product->price);
	}
}
