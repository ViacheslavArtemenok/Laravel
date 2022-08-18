<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.news.index', [
            'newsList' => $this->getNews()
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
            'categoriesList' => $this->getNews()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $this->getNews();
        $max = count($file);
        $request->validate([
            'id' => ['required', 'int', 'min:1', "max:$max"],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'author' => ['required', 'string', 'min:3', 'max:255']
        ]);
        $newNews = [
            'category_id' => $request->input('id'),
            'title'       => $request->input('title'),
            'author'      => $request->input('author'),
            'status'      => 'DRAFT',
            'description' => $request->input('description'),
            'created_at'  => now('Europe/Moscow')->format('d-m-Y H:i')
        ];
        $newKey = count($file[$request->input('id')]['news']) + 1;
        $file[$request->input('id')]['news'][$newKey] = $newNews;
        $this->setNews($file);
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Some text";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.news.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
