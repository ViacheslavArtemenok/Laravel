<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = $this->getNews();
        //list all categories of news
        return view('categories.index', [
            'categoriesList' => $categories
        ]);
    }
}
