<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

   class PersonController extends Controller
{
    public function index(Request $request)
    {
            $item = DB::table('people')->simplePaginate(5);
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
    public function add(Request $request)
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
    public function edit(Request $request)
    {
        $person = Person::find($request->id);
        return view('edit',['form'=>$person]);
    }
    public function update(Request $request)
    {
        $this->validate($request,Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token_']);
        $person->fill($form)->save();
        return redirect('/');
    }
    public function delete(Request $request)
    {
        $person = Person::find($request->id);
        return view('delete',['form'=>$person]);
    }
    public function remove(Request $request)
    {
        Person::find($request->id)->delete();
        return redirect('/');
    }
}