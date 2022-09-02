<?php

namespace Tests\Browser\Admin;

use App\Models\News;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateForm(): void
    {
        $news = News::factory()->create();

        $this->browse(static function (Browser $browser) use ($news) {
            $browser->visit('/admin/news/create')
                ->select('category_id')
                ->select('author_id')
                ->type('title', $news->title)
                ->select('status')
                ->type('image', $news->image)
                ->type('description', $news->description)
                ->press('Сохранить')
                ->assertPathIs('/admin/news');
        });
    }
    public function testEditForm(): void
    {
        $news = News::factory()->create();

        $this->browse(static function (Browser $browser) use ($news) {
            $browser->visit('/admin/news/1/edit')
                ->select('category_id')
                ->select('author_id')
                ->type('title', $news->title)
                ->select('status')
                ->type('image', $news->image)
                ->type('description', $news->description)
                ->press('Сохранить')
                ->assertPathIs('/admin/news');
        });
    }
}
