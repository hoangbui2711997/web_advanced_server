<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryIndexTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_return_collection_of_categories()
    {
        $category = factory(Category::class)->create();
        echo json_encode($this->json('GET', 'api/category'));
        $this->json('GET', 'api/category')
            ->assertJsonFragment(
                ['slug' => $category->slug]
            );
    }
}
