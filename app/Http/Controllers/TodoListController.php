<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;


class TodoListController extends Controller
{
    public function index()
    {
        $items = TodoList::all();
        return view('index', compact('items'));
    }

    public function store(Request $request)
    {
        TodoList::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        TodoList::where('_id', $request->id)->update(
            ['Descr' => $request->descr_list]
        );
        return redirect()->back();
    }    
    
    public function destroy($id)
    {
        TodoList::find($id)->delete();
        return redirect()->back();
    }


    
}
