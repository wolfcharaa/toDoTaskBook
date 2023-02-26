<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function create(Request $request)
    {
        $requestData = [
            ''
        ];
        $taskList = new TaskList();
        $taskList->user()->associate(User::find(2));
        $taskList->save();
        return new JsonResponse([
            'message' => 'Новый список создан'
        ]);
    }
}
