<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{

    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request)
    {
        $todolist = $this->todolistService->getTodolist();
        return response()->view("todolist.todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input("todo");

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodolist();
            return response()->view("todolist.todolist", [
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Tambahkan Task"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todoList']);
    }

    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'todoList']);
    }

    public function editTodo(Request $request, string $todoId)
    {
        $todo = $this->todolistService->findTodoById($todoId)->first();

        if (!$todo) {
            return redirect()->action([TodolistController::class, 'todoList']);
        }

        return response()->view("todolist.edit-todolist", [
            "todo" => $todo
        ]);
    }

    function updateTodo(Request $request, string $todoId): mixed
    {
        $todo = $request->input("todo");

        if (empty($todo)) {
            return redirect()->back();
        }

        $this->todolistService->updateTodo($todoId, $todo);

        return redirect()->action([TodolistController::class, 'todoList']);
    }
}
