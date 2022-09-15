<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Queries\QueryBuilderFactory;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    protected $newsBuilder;

    public function __construct()
    {
        $this->newsBuilder = QueryBuilderFactory::getNews();
    }

    public function index(int $category_id)
    {
        return view('news.index', [
            'newsList' => $this->newsBuilder->getByCategoryPaginate($category_id, 'pagination.all.news')
        ]);
    }

    public function show(int $id)
    {
        if (is_null(Auth::user())) {
            return redirect()->route('login');
        }
        return view('news.show', [
            'news' => $this->newsBuilder->getById($id)
        ]);
    }
}
