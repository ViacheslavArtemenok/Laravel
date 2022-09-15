<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Resources\CreateRequest;
use App\Http\Requests\Resources\EditRequest;
use App\Queries\QueryBuilderFactory;
use Illuminate\Http\RedirectResponse;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $resourceBuilder;

    public function __construct()
    {
        $this->resourceBuilder = QueryBuilderFactory::getResource();
    }

    public function index()
    {
        return view('admin.resources.index', [
            'resourcesList' =>  $this->resourceBuilder->getAllPaginate('pagination.admin.resources')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $resource = $this->resourceBuilder->create($request->validated());
        if ($resource) {
            return redirect()->route('admin.resources.index')
                ->with('success', __('messages.admin.resources.create.success'));
        }
        return back()->with('error', __('messages.admin.resources.create.fail'));
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
        return view('admin.resources.edit', [
            'resource' =>  $this->resourceBuilder->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, Resource $resource): RedirectResponse
    {
        if ($this->resourceBuilder->update($resource, $request->validated())) {
            return redirect()->route('admin.resources.index')
                ->with('success', __('messages.admin.resources.update.success'));
        }
        return back()->with('error', __('messages.admin.resources.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        if ($this->resourceBuilder->delete($resource)) {
            return redirect()->route('admin.resources.index')
                ->with('success', __('messages.admin.resources.delete.success'));
        }
        return back()->with('error', __('messages.admin.resources.delete.fail'));
    }
}
