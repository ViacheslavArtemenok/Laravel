<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Queries\AuthorQueryBuilder;
use App\Queries\CategoryQueryBuilder;
use App\Queries\NewsQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryQueryBuilder $categoryBuilder, NewsQueryBuilder $newsBuilder)
    {
        return view('admin.news.index', [
            'categoriesList' => $categoryBuilder->getCategories(),
            'newsList' => $newsBuilder->getAllNews('pagination.admin.news')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryQueryBuilder $categoryBuilder, AuthorQueryBuilder $authorBuilder)
    {
        $categories = $categoryBuilder->getCategories();
        $authors = $authorBuilder->getAuthors('pagination.admin.authors');
        return view('admin.news.create', [
            'categoriesList' => $categories,
            'authorsList' => $authors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NewsQueryBuilder $newsBuilder): RedirectResponse
    {
        $request->validate([
            'category_id' => ['required', 'int', 'min:1'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author_id' => ['required']
        ]);

        $news = $newsBuilder->create($request->only([
            'category_id',
            'author_id',
            'title',
            'status',
            'image',
            'description'
        ]));

        if ($news) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }

        return back()->with('error', 'Не удалось добавить запись');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, CategoryQueryBuilder $categoriesBuilder, NewsQueryBuilder $newsBuilder)
    {
        return view('admin.news.show', [
            'categoriesList' => $categoriesBuilder->getCategories(),
            'newsList' => $newsBuilder->getNewsByCategory($id, 'pagination.admin.news', true)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(
        $id,
        NewsQueryBuilder $newsBuilder,
        CategoryQueryBuilder $categoryBuilder,
        AuthorQueryBuilder $authorBuilder
    ) {
        $categories = $categoryBuilder->getCategories();
        $authors = $authorBuilder->getAuthors('pagination.admin.authors');
        return view('admin.news.edit', [
            'news' => $newsBuilder->getNewsById($id),
            'categoriesList' => $categories,
            'authorsList' => $authors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        News $news,
        NewsQueryBuilder $newsBuilder
    ): RedirectResponse {
        if ($newsBuilder->update($news, $request->only([
            'category_id',
            'author_id',
            'title',
            'status',
            'image',
            'description'
        ]))) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно обновлена');
        }

        return back()->with('error', 'Не удалось обновить запись');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, NewsQueryBuilder $newsBuilder): RedirectResponse
    {
        if ($newsBuilder->delete($id)) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно удалена');
        }

        return back()->with('error', 'Не удалось удалить запись');
    }
}
