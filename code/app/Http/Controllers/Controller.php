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
        1 => 'World',
        2 => 'Persons',
        3 => 'Science',
        4 => 'Medicine',
        5 => 'Sport',
        6 => 'Animals'
    ];

    public function getDataNews(): array
    {
        $categories = [];
        $faker = Factory::create();
        foreach ($this->categories as $key => $category) {
            $categories[$key] = [
                'id' => $key,
                'title' => $category,
                'description' => $faker->text(300),
                'news' => []
            ];
            for ($i = 1; $i < 10; $i++) {
                $news[$i] = [
                    'category_id' => $key,
                    'title'       => $faker->jobTitle(),
                    'author'      => $faker->userName(),
                    'status'      => 'DRAFT',
                    'description' => $faker->text(2000),
                    'created_at'  => now('Europe/Moscow')->format('d-m-Y H:i')
                ];
                $categories[$key]['news'] = $news;
            }
        }
        return $categories;
    }

    public function setNews(array $file = []): void
    {
        if (count($file) == 0) {
            $file = $this->getDataNews();
        }
        file_put_contents('tempStore.json', json_encode($file, JSON_UNESCAPED_UNICODE));
    }

    public function getNews(): array
    {
        $newFile = file_get_contents('tempStore.json');
        $taskList = json_decode($newFile, true);
        return $taskList;
    }
}
