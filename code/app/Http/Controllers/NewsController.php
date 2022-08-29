<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Queries\NewsQueryBuilder;

class NewsController extends Controller
{

    public function index(int $category_id, NewsQueryBuilder $newsBuilder)
    {
        //list all news
        return view('news.index', [
            'newsList' => $newsBuilder->getNewsByCategory($category_id, 'pagination.all.news')
        ]);
    }

    public function show(int $id, NewsQueryBuilder $newsBuilder)
    {
        // return current news
        return view('news.show', [
            'news' => $newsBuilder->getNewsById($id)
        ]);
    }
}
