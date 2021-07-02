<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

   class PersonController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$request->sort){
            $sort = 'id';
        }else{
            $sort = $request->sort;
        }
        $items = Person::orderBy($sort,'asc')->paginate(5);
        $param = ['items' => $items,'sort' => $sort,'user' => $user];
        return view('index',$param);
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
    public function getAuth(Request $request)
    {
        $param = ['message' => 'ログインしてください。'];
        return view('person.auth',$param);
    }

    public function postAuth(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email,'password' => $password])){
            $msg = 'ログインしました。('.Auth::user()->name.')';
        }else{
            $msg = 'ログインに失敗しました。';
        }
        return view('person.auth',['message'=> $msg]);
    }
}