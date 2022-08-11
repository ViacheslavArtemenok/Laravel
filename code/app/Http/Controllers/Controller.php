<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use function PHPUnit\Framework\isNull;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    private $categories = [
        'World',
        'People',
        'Science',
        'Sport',
        'Animals'
    ];

    public function getNews(int $category_id = null, int $id = null): array
    {
        $news = [];
        $key = $category_id - 1;
        $faker = Factory::create();

        if ($category_id) {
            for ($i = 1; $i < 6; $i++) {
                $news[$i] = [
                    'category'    => $this->categories[$key],
                    'category_id' => $category_id,
                    'title'       => $faker->jobTitle(),
                    'author'      => $faker->userName(),
                    'status'      => 'DRAFT',
                    'description' => $faker->text(2000),
                    'created_at'  => now('Europe/Moscow')
                ];
            }
            if ($id) {
                $concreteNews = $news[$id];
                return $concreteNews;
            } else return $news;
        } else return $this->categories;
    }
}
