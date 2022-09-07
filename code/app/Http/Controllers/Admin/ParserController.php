<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Queries\QueryBuilderFactory;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;

class ParserController extends Controller
{
    protected $authorBuilder;
    protected $categoryBuilder;
    protected $newsBuilder;

    public function __construct()
    {
        $this->authorBuilder = QueryBuilderFactory::getAuthor();
        $this->categoryBuilder = QueryBuilderFactory::getCategory();
        $this->newsBuilder = QueryBuilderFactory::getNews();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Parser $parser)
    {
        $load = $parser->setLink("https://news.yandex.ru/music.rss")
            ->getParseData();
        $author = [
            'name' => 'Yandex',
            'phone' => '+7 (495) 739-70-00',
            'email' => 'pr@yandex-team.ru',
            'text' => 'Российская транснациональная компания в отрасли информационных технологий, чьё головное юридическое лицо зарегистрировано в Нидерландах, владеющая одноимённой системой поиска в интернете, интернет-порталом и веб-службами в нескольких странах.',
        ];
        $category = [
            'title' => $load['title'],
            'description' => $load['description'],
        ];

        $categoryGet = DB::table('categories')
            ->where('title', '=', $category['title'])
            ->get();
        if (count($categoryGet) === 0) {
            $this->categoryBuilder->create($category);
            $categoryGet = DB::table('categories')
                ->where('title', '=', $category['title'])
                ->get();
        }
        $authorGet = DB::table('authors')
            ->where('name', '=', $author['name'])
            ->get();
        if (count($authorGet) === 0) {
            $this->authorBuilder->create($author);
            $authorGet = DB::table('authors')
                ->where('name', '=', $author['name'])
                ->get();
        }
        $newsGet = DB::table('news')
            ->where('category_id', '=', $categoryGet[0]->id)
            ->where('author_id', '=', $authorGet[0]->id)
            ->get();
        if (count($newsGet) === 0) {
            foreach ($load['news'] as $itemNews) {
                $news = [
                    'category_id' => $categoryGet[0]->id,
                    'author_id' => $authorGet[0]->id,
                    'title' => $itemNews['title'],
                    'status' => 'ACTIVE',
                    'image' => $load['image'],
                    'description' => $itemNews['description'],
                    'link' => $itemNews['link'],
                ];
                $this->newsBuilder->create($news);
            }
        }


        dd($load);
    }
}
