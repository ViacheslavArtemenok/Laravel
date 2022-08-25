<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(int $category_id)
    {
        $category = app(Category::class)->getCategoryById($category_id);
        $news = app(News::class)->getNews($category_id);
        //list all news
        return view('news.index', [
            'newsList' => $news,
            'category' => $category
        ]);
    }

    public function show(int $category_id, int $id)
    {
        // return current news
        $category = app(Category::class)->getCategoryById($category_id);
        $news = app(News::class)->getNewsById($id);
        return view('news.show', [
            'news' => $news[0],
            'category' => $category,
        ]);
    }
}
