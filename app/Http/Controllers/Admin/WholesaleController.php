<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wholesale;
use Illuminate\Http\Request;

class WholesaleController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('site.wholesale');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function adminIndex()
    {
        return view('backend.admin.whole-sale.index');
    }

    public function getWholesales(Request $request)
    {
        $wholesales = Wholesale::latest()->paginate(5);
        return response()->json($wholesales);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $wholesale = new Wholesale();
        $wholesale->fill($request->all());
        $wholesale->save();

        return response()->json($wholesale);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeWholesaleRead(Request $request)
    {
        $wholesale = Wholesale::find($request->id);
        $wholesale->read = !$wholesale->read;
        $wholesale->update();
        return response()->json($wholesale);
    }

}
