<?php

namespace Tests\Feature\Admin;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_categories_index_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.categories.index'));
        $response->assertStatus(200);
    }
    public function test_categories_create_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.categories.create'));
        $response->assertStatus(200);
    }
    public function test_categories_store_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.categories.index'));
        $response->assertStatus(200);
    }
}
