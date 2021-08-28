<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.admin.order.index');
    }
}
