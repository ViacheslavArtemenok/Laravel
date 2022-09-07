<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\EditRequest;
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
    protected $authorBuilder;
    protected $categoryBuilder;
    protected $newsBuilder;

    public function __construct()
    {
        $this->authorBuilder = QueryBuilderFactory::getAuthor();
        $this->categoryBuilder = QueryBuilderFactory::getCategory();
        $this->newsBuilder = QueryBuilderFactory::getNews();
    }

    public function index()
    {
        return view('admin.news.index', [
            'categoriesList' => $this->categoryBuilder->getAll(),
            'newsList' => $this->newsBuilder->getAllPaginate('pagination.admin.news')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create', [
            'categoriesList' => $this->categoryBuilder->getAll(),
            'authorsList' => $this->authorBuilder->getAllPaginate('pagination.admin.authors')
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
        if ($this->newsBuilder->create($request->validated())) {
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
        return view('admin.news.show', [
            'categoriesList' => $this->categoryBuilder->getAll(),
            'newsList' => $this->newsBuilder->getByCategoryPaginate($id, 'pagination.admin.news', true)
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
        return view('admin.news.edit', [
            'news' => $this->newsBuilder->getById($id),
            'categoriesList' => $this->categoryBuilder->getAll(),
            'authorsList' => $this->authorBuilder->getAllPaginate('pagination.admin.authors')
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
        if ($this->newsBuilder->update($news, $request->validated())) {
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
        if ($this->newsBuilder->delete($news)) {
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.delete.success'));
        }
        return back()->with('error', __('messages.admin.news.delete.fail'));
    }
}
