<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::select('select * from people');
        return view('index', ['items' => $items]);
    }
}