<?php

declare(strict_types=1);

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $categories = [
        'Persons',
        'Science',
        'Medicine',
        'Sport',
        'Animals'
    ];
    public function run(): void
    {
        DB::table('categories')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create();
        $data = [];

        foreach ($this->categories as $category) {
            $data[] = [
                'title'       => $category,
                'description' =>  $faker->text(300),
                'created_at'  => now('Europe/Moscow'),
                'updated_at'  => now('Europe/Moscow')
            ];
        }

        return $data;
    }
    public function getCategories(): array
    {
        return $this->categories;
    }
}
