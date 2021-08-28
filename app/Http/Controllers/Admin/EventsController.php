<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EventsController extends Controller
{

    public function index()
    {
        return view('backend.admin.event.index');
    }

}
