<?php

namespace Tests\Feature\Models\Products;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_show_collection_of_product()
    {
        $product = factory(Product::class)->create();
        echo $product;
        $this->json('GET', "api/products/$product->slug")
            ->assertJsonFragment([
                'slug' => $product->slug
            ]);

//        $response->assertStatus(200);
    }

    public function test_it_product_is_paginate()
    {
        $product = factory(Product::class)->create();
        echo $product;
        $this->json('GET', 'api/products')
            ->assertJsonStructure([
                'meta'
            ]);

//        $response->assertStatus(200);
    }

    public function test_it_product_show()
    {
        $product = factory(Product::class)->create();
        echo $product;
        $this->json('GET', "api/products/$product->slug")
            ->assertJsonStructure([
                'data' => [
                    'variations' => []
                ]
            ]);
    }
}
