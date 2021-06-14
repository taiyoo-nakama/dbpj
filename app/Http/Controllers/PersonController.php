<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::table('people')->get();
        return view('index',['items'=>$items]);
    }
    public function show(Request $request)
    {
        $param = $request->param;
        $items = DB::table('people')->where('name','like','%'.$param.'%')->orWhere('age','like','%'.$param.'%')->get();
        return view('show',['items' => $items]);
    }
}