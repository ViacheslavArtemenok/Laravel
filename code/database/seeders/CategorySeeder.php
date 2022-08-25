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
        1 => 'World',
        2 => 'Persons',
        3 => 'Science',
        4 => 'Medicine',
        5 => 'Sport',
        6 => 'Animals'
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
}
