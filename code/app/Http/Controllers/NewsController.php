<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(int $category_id)
    {
        $news = $this->getNews($category_id);
        //list all news
        return view('news.index', [
            'newsList' => $news
        ]);
    }

    public function show(int $category_id, int $id)
    {
        // return current news
        $news = $this->getNews($category_id, $id);
        return view('news.show', [
            'news' => $news
        ]);
    }
}
