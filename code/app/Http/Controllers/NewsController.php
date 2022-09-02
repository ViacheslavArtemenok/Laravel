<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Queries\QueryBuilderFactory;

class NewsController extends Controller
{

    public function index(int $category_id)
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        return view('news.index', [
            'newsList' => $newsBuilder->getByCategoryPaginate($category_id, 'pagination.all.news')
        ]);
    }

    public function show(int $id)
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        return view('news.show', [
            'news' => $newsBuilder->getById($id)
        ]);
    }
}
