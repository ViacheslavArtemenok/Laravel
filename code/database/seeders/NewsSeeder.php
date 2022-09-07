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
    protected $images = [
        'https://content.tviz.tv/gfx/res/43175/2qw5alqj7sao0cc404c0kwwck.jpg',
        'https://s3-eu-west-1.amazonaws.com/static.anygator.com/static-anygator2/thumbs/de/44/44463e208494ecdb1f6e897f2c60b9ad57e8da6e/big.jpg',
        'https://quizpug.com/wp-content/uploads/qc-images/58beccd536c28.jpg',
        'https://quizdoo.com/wp-content/uploads/qc-images/5527e865db6a5.jpg',
        'https://rina-anyarskaya.ru/_nw/1/14247810.jpg',
        'https://funchrome.ru/wp-content/uploads/2019/01/Новости-FunChrome.jpg',
        'https://i.pinimg.com/originals/96/9c/c5/969cc57d1707052bab32f6dd508c67b9.jpg',
        'https://droit-des-affaires.efe.fr/wp-content/uploads/sites/9/2016/10/2.jpg',
        'https://img.etimg.com/thumb/msid-72106575,width-640,resizemode-4,imgsize-126521/spotting-fake-news.jpg',
        'https://www.newslinereport.com/online/nota_brasil-aprueba-ley-que-impone-impuestos-a-servicios-como-netflix-y-amazon.jpg',
        'https://disright.org/sites/default/files/field/image/site_2.jpg',
        'https://www.produzionidalbasso.com/media/projects/10476/images/tbi-2-3-tv-streaming.jpg',
        'https://content.tviz.tv/gfx/res/44129/ep2fmxne4uo8w0kwcckwocs8k.jpg',
        'https://thewatchtowers.org/wp-content/uploads/2020/02/GettyImages-1139127444.jpg',
        'https://www.newslinereport.com/online/nota_fox-news-considera-expandirse-mas-alla-de-la-distribucion-tradicional.jpg',
        'https://media.breitbart.com/media/2016/04/Megyn-Kelly-GOP-Debate-AP_654383272292-640x480.jpg',
        'https://cdn.beta.qalampir.uz/uploads/VI/f_XfY1XpM0A3A2AGQOdhu5jov0Eqn708.jpg',
        'https://content.tviz.tv/gfx/res/43583/3bulhnu511uss0osg4c0gc8cs.jpg',
        'https://www.mixedtimes.com/images/news/headlines/featured/2017-05/e5ae340ea0.jpeg'
    ];

    public function run(): void
    {
        DB::table('news')->insert($this->getData());
    }

    protected function getData(): array
    {
        $faker = Factory::create();
        $categories = app(CategorySeeder::class)->getCategories();
        $data = [];
        $lastItem = count($this->images) - 1;
        for ($e = 1; $e <= count($categories); $e++) {
            for ($i = 1; $i < 55; $i++) {
                $data[] = [
                    'category_id' => $e,
                    'title'       => $faker->jobTitle(),
                    'author_id'      => rand(1, 36),
                    'status'      => News::ACTIVE,
                    'image'       => $this->images[rand(0, $lastItem)],
                    'description' =>  $faker->text(2000),
                    'link' => 'https://www.rbc.ru',
                    'created_at'  => now('Europe/Moscow'),
                    'updated_at'  => now('Europe/Moscow')
                ];
            }
        }
        return $data;
    }
}
