<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

   class PersonController extends Controller
{
    public function index(Request $request)
    {
        $hasItems = Person::has('boards')->get();
        $noItems = Person::doesntHave('boards')->get();
        $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
        return view('person.index',$param);
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