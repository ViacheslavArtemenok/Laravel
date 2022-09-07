<?php

namespace Tests\Browser\Admin;

use App\Models\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateForm(): void
    {
        $author = Author::factory()->create();

        $this->browse(static function (Browser $browser) use ($author) {
            $browser->visit('/admin/authors/create')
                ->type('name', $author->name)
                ->type('phone', $author->phone)
                ->type('email', $author->email)
                ->type('text', $author->text)
                ->press('Сохранить')
                ->assertPathIs('/admin/authors');
        });
    }
    public function testEditForm(): void
    {
        $author = Author::factory()->create();

        $this->browse(static function (Browser $browser) use ($author) {
            $browser->visit('/admin/authors/1/edit')
                ->type('name', $author->name)
                ->type('phone', $author->phone)
                ->type('email', $author->email)
                ->type('text', $author->text)
                ->press('Сохранить')
                ->assertPathIs('/admin/authors');
        });
    }
}
