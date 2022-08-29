<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use App\Http\Controllers\Controller;
use App\Queries\AuthorQueryBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorQueryBuilder $builder)
    {
        return view('admin.authors.index', [
            'authorsList' =>  $builder->getAuthors('pagination.admin.authors')
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
    public function store(Request $request, AuthorQueryBuilder $builder): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['required'],
            'email' => ['required']
        ]);

        $author = $builder->create($request->only(['name', 'phone', 'email', 'text']));

        if ($author) {
            return redirect()->route('admin.authors.index')
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
    public function show($id)
    {
        return view('admin.authors.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, AuthorQueryBuilder $builder)
    {
        return view('admin.authors.edit', [
            'author' =>  $builder->getAuthorById($id)
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
        Author $author,
        AuthorQueryBuilder $builder
    ): RedirectResponse {
        if ($builder->update($author, $request->only([
            'name', 'phone', 'email', 'text'
        ]))) {
            return redirect()->route('admin.authors.index')
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
    public function destroy(int $id, AuthorQueryBuilder $builder): RedirectResponse
    {
        if ($builder->delete($id)) {
            return redirect()->route('admin.authors.index')
                ->with('success', 'Запись успешно удалена');
        }

        return back()->with('error', 'Не удалось удалить запись');
    }
}
