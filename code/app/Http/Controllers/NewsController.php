<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(int $category_id)
    {
        //$this->setNews();
        $news = $this->getNews();
        //list all news
        return view('news.index', [
            'newsList' => $news,
            'category_id' => $category_id
        ]);
    }

    public function show(int $category_id, int $id)
    {
        // return current news
        $news = $this->getNews();
        return view('news.show', [
            'newsList' => $news,
            'category_id' => $category_id,
            'id' => $id
        ]);
    }
}
