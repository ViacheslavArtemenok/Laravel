<?php

namespace App\Http\Controllers;

use App\Queries\QueryBuilderFactory;

class CategoryController extends Controller
{
    public function index()
    {
        //list all categories of news
        $categoryBuilder = QueryBuilderFactory::getCategory();
        return view('categories.index', [
            'categoriesList' => $categoryBuilder->getAll()
        ]);
    }
}
