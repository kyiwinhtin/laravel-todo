<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
    	$todos = Todo::all();
    	return view('todo')->with('todos',$todos);
    }

    public function store(Request $request)
    {
    	$todo = new Todo;
    	$todo->todo = $request->todo;
    	$todo->save();
    	return redirect()->back();
    }

    public function destory($id)
    {
    	$todo = Todo::find($id);
    	$todo->delete();
    	return redirect()->back();
    }

    public function ajaxGet(Request $request,$id)
    {
    	$todo = Todo::find($id);
        $todo->todo = $request->todo;
        $todo->update();
        return response()->json($todo);
    }
}
