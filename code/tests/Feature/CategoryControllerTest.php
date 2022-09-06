<?php

namespace Tests\Feature;

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
        $response = $this->withoutExceptionHandling()->get(route('categories.index'));

        $response->assertStatus(200);
    }
}
