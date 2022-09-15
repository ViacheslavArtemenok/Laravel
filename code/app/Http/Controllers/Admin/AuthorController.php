<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authors\CreateRequest;
use App\Http\Requests\Authors\EditRequest;
use App\Queries\QueryBuilderFactory;
use Illuminate\Http\RedirectResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $authorBuilder;

    public function __construct()
    {
        $this->authorBuilder = QueryBuilderFactory::getAuthor();
    }

    public function index()
    {
        return view('admin.authors.index', [
            'authorsList' =>  $this->authorBuilder->getAllPaginate('pagination.admin.authors')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $author = $this->authorBuilder->create($request->validated());
        if ($author) {
            return redirect()->route('admin.authors.index')
                ->with('success', __('messages.admin.authors.create.success'));
        }
        return back()->with('error', __('messages.admin.authors.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.authors.edit', [
            'author' =>  $this->authorBuilder->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Author $author): RedirectResponse
    {
        if ($this->authorBuilder->update($author, $request->validated())) {
            return redirect()->route('admin.authors.index')
                ->with('success', __('messages.admin.authors.update.success'));
        }
        return back()->with('error', __('messages.admin.authors.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author): RedirectResponse
    {
        if ($this->authorBuilder->delete($author)) {
            return redirect()->route('admin.authors.index')
                ->with('success', __('messages.admin.authors.delete.success'));
        }
        return back()->with('error', __('messages.admin.authors.delete.fail'));
    }
}
