<?php

namespace Tests\Feature;

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
        $response = $this->withoutExceptionHandling()->get('categories/1/news');

        $response->assertStatus(200);
    }
    public function test_news_show_successful_page()
    {
        $response = $this->withoutExceptionHandling()->get('categories/1/news/2');

        $response->assertStatus(200);
    }
}
