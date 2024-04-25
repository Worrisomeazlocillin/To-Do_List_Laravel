<?php

namespace App\Services\Impl;

use App\Models\TodoList;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{

    public function saveTodo(string $id, string $todo): void
    {
        TodoList::create([
            'todo' => $todo,
            'id_user' => Session::get('user_id')
        ]);
    }

    public function getTodolist(): mixed
    {
        return TodoList::where("id_user", Session::get("user_id"))->get();
    }

    public function removeTodo(string $todoId)
    {
        TodoList::where("id", $todoId)->delete();
    }

    public function findTodoById(string $todoId): mixed
    {
        return TodoList::where("id_user", Session::get("user_id"))
            ->where("id", $todoId);
    }


    public function updateTodo(string $todoId, string $todo): void
    {
        TodoList::where("id", $todoId)->update([
            "todo" => $todo
        ]);
    }
}
