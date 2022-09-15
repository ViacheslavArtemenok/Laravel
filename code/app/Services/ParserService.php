<?php

declare(strict_types=1);

namespace App\Services;

use App\Queries\QueryBuilderFactory;
use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{
    private string $link;
    protected $authorBuilder;
    protected $categoryBuilder;
    protected $newsBuilder;

    public function __construct()
    {
        $this->authorBuilder = QueryBuilderFactory::getAuthor();
        $this->categoryBuilder = QueryBuilderFactory::getCategory();
        $this->newsBuilder = QueryBuilderFactory::getNews();
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function saveParseData(): void
    {
        $xml = XmlParser::load($this->link);
        $imageDefoltUrl = 'news/haTuYa4fcbHax3sGnqFmKvZEHWBS9qGrdlYy50Vx.png';
        $data = $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,author,description,pubDate]'
            ]
        ]);

        $category = [
            'title' => $data['title'],
            'description' => $data['description'],
        ];

        $categoryGet = DB::table('categories')
            ->where('title', '=', $category['title'])
            ->exists();
        if ($categoryGet === false) {
            $this->categoryBuilder->create($category);
        }
        $categoryGet = DB::table('categories')
            ->where('title', '=', $category['title'])
            ->get();

        foreach ($data['news'] as $itemNews) {
            $newsGet = DB::table('news')
                ->where('category_id', '=', $categoryGet[0]->id) //Исключить одинаковые новости в разных категориях
                ->where('title', '=', $itemNews['title'])
                ->exists();
            if ($newsGet === false) {
                $authorGet = DB::table('authors')
                    ->where('name', '=', $itemNews['author'])
                    ->exists();
                if ($authorGet === false) {
                    $author = [
                        'name' => $itemNews['author'],
                        'phone' => '+7 (000) 000-00-00',
                        'email' => 'example@gmail.com',
                        'text' => '',
                    ];
                    $this->authorBuilder->create($author);
                }
                $authorGet = DB::table('authors')
                    ->where('name', '=', $itemNews['author'])
                    ->get();

                $news = [
                    'category_id' => $categoryGet[0]->id,
                    'author_id' => $authorGet[0]->id,
                    'title' => $itemNews['title'],
                    'status' => 'ACTIVE',
                    'image' => $imageDefoltUrl,
                    'description' => $itemNews['description'],
                    'link' => $itemNews['link'],
                ];
                $this->newsBuilder->create($news);
            }
        }
    }
}
