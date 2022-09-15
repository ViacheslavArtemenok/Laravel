<?php

declare(strict_types=1);

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('authors')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create();
        $data = [];

        for ($i = 1; $i < 37; $i++) {
            $data[] = [
                'name'       => $faker->userName(),
                'phone'      => '+7 ' . '(9' . rand(10, 99) . ') ' . rand(100, 999) . '-' . rand(10, 99) . '-' . rand(10, 99),
                'email'      => $faker->email(),
                'text'       => $faker->text(200),
                'created_at'  => now('Europe/Moscow'),
                'updated_at'  => now('Europe/Moscow')
            ];
        }

        return $data;
    }
}
