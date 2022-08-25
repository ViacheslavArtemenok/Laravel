<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\News;
use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('news')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create();
        $categories = app(Category::class)->getCategories();
        $data = [];
        foreach ($categories as $categoriesItem) {
            for ($i = 1; $i < 25; $i++) {
                $data[] = [
                    'category_id' => $categoriesItem->id,
                    'title'       => $faker->jobTitle(),
                    'author_id'      => rand(1, 12),
                    'status'      => News::DRAFT,
                    'image'       => $faker->imageUrl(),
                    'description' =>  $faker->text(2000),
                    'created_at'  => now('Europe/Moscow'),
                    'updated_at'  => now('Europe/Moscow')
                ];
            }
        }
        return $data;
    }
}
