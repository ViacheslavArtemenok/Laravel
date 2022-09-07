<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\EditRequest;
use Illuminate\Http\RedirectResponse;
use App\Queries\QueryBuilderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $userBuilder;

    public function __construct()
    {
        $this->userBuilder = QueryBuilderFactory::getUser();
    }

    public function index()
    {
        return view('account.index');
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
    public function store(Request $request)
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
    public function edit($id)
    {
        return view('account.edit', [
            'account' =>  $this->userBuilder->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request): RedirectResponse
    {
        $data = [];
        $user = Auth::user();
        if (Hash::check($request->validated()['password'], $user->password)) {
            $data = $request->validated();
            if ($request->validated()['new_password']) {
                $data['password'] = Hash::make($request->validated()['new_password']);
            } else {
                $data['password'] = Hash::make($request->validated()['password']);
            }
            unset($data['new_password']);
            if ($this->userBuilder->update($user, $data)) {
                return redirect()->route('account.index')
                    ->with('success', __('messages.admin.users.update.success'));
            }
        }
        return back()->with('error', __('messages.admin.users.update.fail'));
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
