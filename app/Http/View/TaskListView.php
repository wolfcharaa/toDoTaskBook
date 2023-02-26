<?php

namespace App\Http\View;

use App\Models\Task;
use App\Models\User;
use App\Service\CustomValidator;
use Illuminate\Http\Request;

class TaskListView
{
    public function index(Request $request, CustomValidator $validator) {
        $validator->validate([
           'status' =>  'nullable|in:yes,no'
        ]);
        $status = $request->get('status', false);
        /** @var User $user */
        $user = User::query()->find(2);
        $taskListObject = $user->taskList;
        if ($status) {
            $tasksArray = $taskListObject->tasks->where('status', '=', $status)->reverse();
        } else {
            $tasksArray = $taskListObject->tasks->reverse();
        }
        return view('todo', [
            'taskListObject' => $taskListObject,
            'tasksArray'     => $tasksArray
        ]);
    }
}
