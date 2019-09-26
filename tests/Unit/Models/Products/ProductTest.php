<?php

namespace Tests\Unit\Models\Products;

use App\Models\Product;
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
}
