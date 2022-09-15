<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\JobNewsParsing;
use App\Queries\QueryBuilderFactory;
use Illuminate\Support\Facades\DB;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        //Каскадное удаление категорий со старыми новостями
        if (DB::table('categories')->delete()) {
            $resourceBuilder = QueryBuilderFactory::getResource();
            $resources = $resourceBuilder->getAll();
            foreach ($resources as $resource) {
                \dispatch(new JobNewsParsing($resource->link));
            }
            return redirect()->route('admin.index')
                ->with('success', __('messages.admin.parsing.create.success'));
        }
        return back()->with('error', __('messages.admin.parsing.create.fail'));
    }
}
