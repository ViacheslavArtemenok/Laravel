<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\EditRequest;
use App\Queries\QueryBuilderFactory;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    protected $userBuilder;

    public function __construct()
    {
        $this->userBuilder = QueryBuilderFactory::getUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'usersList' =>  $this->userBuilder->getAllPaginate('pagination.admin.users')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        //
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
        return view('admin.users.edit', [
            'user' =>  $this->userBuilder->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Users\EditRequest  $request
     * @param  object $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditRequest $request, User $user): RedirectResponse
    {
        if ($this->userBuilder->update($user, $request->validated())) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.update.success'));
        }
        return back()->with('error', __('messages.admin.users.update.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($this->userBuilder->delete($user)) {
            return redirect()->route('admin.users.index')
                ->with('success', __('messages.admin.users.delete.success'));
        }
        return back()->with('error', __('messages.admin.users.delete.fail'));
    }
}
