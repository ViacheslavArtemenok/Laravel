<?php

namespace App\Http\Controllers;

use App\Queries\QueryBuilderFactory;

class CategoryController extends Controller
{
    protected $categoryBuilder;

    public function __construct()
    {
        $this->categoryBuilder = QueryBuilderFactory::getCategory();
    }
    public function index()
    {
        //list all categories of news
        return view('categories.index', [
            'categoriesList' => $this->categoryBuilder->getAll()
        ]);
    }
}
