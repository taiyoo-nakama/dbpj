<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('index',['items'=>$items]);
    }
    public function find(Request $request)
    {
        return view('find',['input'=>'']);
    }
    public function search(Request $request)
    {
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThen($min)->ageLessThen($max)->first();
        $param = [
            'input' => $request->input,
            'item' => $item
        ];
        return view('find',$param);
    }
    public function add(Request $Request)
    {
        return view('add');
    }
    public function create(Request $request)
    {
        $this->validate($request,Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token_']);
        $person->fill($form)->save();
        return redirect('/');
    }
}