<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Queries\CategoryQueryBuilder;

class CategoryController extends Controller
{
    public function index(CategoryQueryBuilder $categoriesBuilder)
    {
        //list all categories of news
        return view('categories.index', [
            'categoriesList' => $categoriesBuilder->getCategories()
        ]);
    }
}
