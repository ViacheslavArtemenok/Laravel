<?php

namespace Tests\Feature\Admin;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_news_index_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.news.index'));

        $response->assertStatus(200);
    }
    public function test_news_create_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.news.create'));
        $response->assertStatus(200);
    }
    public function test_news_store_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get(route('admin.news.index'));
        $response->assertStatus(200);
    }
}
