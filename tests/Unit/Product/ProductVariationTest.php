<?php

namespace Tests\Unit\Product;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use App\Models\Stock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductVariationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

	public function test_it_has_one_variation_type()
	{
		$variation = factory(ProductVariation::class)->create();
		$this->assertInstanceOf(ProductVariationType::class, $variation->type);
	}

	public function test_it_belong_to_product()
	{
		$variation = factory(ProductVariation::class)->create();
		$product = factory(Product::class)->create();
		$product->variations()->save(
			$variation
		);
		$this->assertInstanceOf(Product::class, $variation->product);
	}

	public function test_it_returns_the_product_price_if_price_is_null()
	{
		$product = factory(Product::class)->create([
			'price' => 1000
		]);

		$variation = factory(ProductVariation::class)->create([
			'price' => null,
			'product_id' => $product->id
		]);

		echo $variation->price->amount();
		echo $product->price->amount();

		$this->assertEquals($product->price->amount(), $variation->price->amount());
	}

	public function test_it_can_check_if_the_variation_price_is_different_to_the_product()
	{
		$product = factory(Product::class)->create();
		$variation = factory(ProductVariation::class)->create([
			'product_id' => $product->id
		]);

		dump($product->price->amount());
		dump($variation->price->amount());

		$this->assertTrue($variation->priceVaries());
	}

	public function test_it_can_check_if_the_variation_price_is_same_to_the_product()
	{
		$product = factory(Product::class)->create();
		$variation = factory(ProductVariation::class)->create([
			'product_id' => $product->id,
			'price' => null
		]);

		$this->assertFalse($variation->priceVaries());
	}

	public function test_it_has_many_stocks()
	{
		$variation = factory(ProductVariation::class)->create();
		$variation->stocks()->save(
			$stock = factory(Stock::class)->make()
		);
		$this->assertInstanceOf(Stock::class, $variation->stocks->first());
	}

	public function test_it_has_stock_information()
	{
		
	}
}
