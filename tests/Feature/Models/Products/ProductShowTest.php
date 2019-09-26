<?php

namespace Tests\Feature\Models\Products;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductShowTest extends TestCase
{
    public function test_it_fails_if_a_product_cant_be_found()
    {
        $this->json('GET', 'api/products/doesnt_exists')
            ->assertNotFound();

        $this->json('GET', 'api/products/doesnt_exists')
            ->assertStatus(404);
    }
}
