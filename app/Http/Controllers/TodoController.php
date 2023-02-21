<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::all();
            return view('todo', [
                'value' => dd($todos)
            ]);


    }

    public function create()
    {
        Todo::create(
            [
                'title' => 'Новая задача',
                'description' => 'Описание задачи…',
            ]
        );

        return redirect()->route('todo.index');

    }

    public function show(Todo $todo, $id)
    {
        $todos = $todo->find($id);

        return view('todo', [
            'value' => dd($todos)
        ]);
    }

}
