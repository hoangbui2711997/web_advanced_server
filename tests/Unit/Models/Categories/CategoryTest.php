<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_many_children()
    {
        $category = factory(Category::class)->create();
        $category->children()->save(
            factory(Category::class)->create()
        );
        $this->assertInstanceOf(Category::class, $category);
        $this->assertInstanceOf(Category::class, $category->children()->first());
    }

    public function test_it_fetch_only_parent()
    {
        $category = factory(Category::class)->create();
        $category->children()->save(
            factory(Category::class)->create()
        );
        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_ordered_by_order()
    {
        factory(Category::class)->create([
            'order' => 2
        ]);
        $category = factory(Category::class)->create([
            'order' => 1
        ]);

        $this->assertEquals($category->name, Category::ordered('order')->first()->name);
    }
}
