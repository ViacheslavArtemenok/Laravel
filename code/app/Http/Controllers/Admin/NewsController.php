<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
use App\Queries\AuthorQueryBuilder;
use App\Queries\CategoryQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\QueryBuilderFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        $categoryBuilder = QueryBuilderFactory::getCategory();
        return view('admin.news.index', [
            'categoriesList' => $categoryBuilder->getAll(),
            'newsList' => $newsBuilder->getAllPaginate('pagination.admin.news')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryBuilder = QueryBuilderFactory::getCategory();
        $authorBuilder = QueryBuilderFactory::getAuthor();
        return view('admin.news.create', [
            'categoriesList' => $categoryBuilder->getAll(),
            'authorsList' => $authorBuilder->getAllPaginate('pagination.admin.authors')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        if ($newsBuilder->create($request->validated())) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.create.success'));
        }
        return back()->with('error', __('messages.admin.news.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $categoryBuilder = QueryBuilderFactory::getCategory();
        $newsBuilder = QueryBuilderFactory::getNews();
        return view('admin.news.show', [
            'categoriesList' => $categoryBuilder->getAll(),
            'newsList' => $newsBuilder->getByCategoryPaginate($id, 'pagination.admin.news', true)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $categoryBuilder = QueryBuilderFactory::getCategory();
        $authorBuilder = QueryBuilderFactory::getAuthor();
        $newsBuilder = QueryBuilderFactory::getNews();
        return view('admin.news.edit', [
            'news' => $newsBuilder->getById($id),
            'categoriesList' => $categoryBuilder->getAll(),
            'authorsList' => $authorBuilder->getAllPaginate('pagination.admin.authors')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, News $news): RedirectResponse
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        if ($newsBuilder->update($news, $request->validated())) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.update.success'));
        }
        return back()->with('error', __('messages.admin.news.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news): RedirectResponse
    {
        $newsBuilder = QueryBuilderFactory::getNews();
        if ($newsBuilder->delete($news)) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.delete.success'));
        }
        return back()->with('error', __('messages.admin.news.delete.fail'));
    }
}
