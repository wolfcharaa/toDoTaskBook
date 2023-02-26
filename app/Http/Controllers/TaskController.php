<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use App\Service\CustomValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return new JsonResponse(Task::all());
    }
    public function create(Request $request, CustomValidator $validator)
    {
        $requestData = $validator->validate([
            'taskListId'   => 'required',
            'description'  => 'required',
            'title'        => 'required',
        ]);
        $task = new Task();
        $task->taskList()->associate(TaskList::query()->find($requestData['taskListId']));
        $task->description = $requestData['description'];
        $task->title = $requestData['title'];
        $task->status = Task::STATUS_NO;
        $task->save();
        return redirect('/');
        return new JsonResponse([
            'message' => 'Создана новая задача'
        ]);
    }

    public function delete(Request $request, int $id)
    {
        $task = Task::query()->find($id);
        $task->delete();
        return redirect('/');
        return new JsonResponse([
            'message' => 'Удален успешно. По номеру ' . $id
        ]);
    }

    public function update(Request $request, int $id, CustomValidator $validator)
    {
        $requestData = $validator->validate([
            'description' => 'required',
            'title' => 'required',
            'status' => 'nullable',
        ]);
        $task = Task::query()->find($id);
        $task->description = $requestData['description'];
        $task->title = $requestData['title'];
        $task->status = $requestData['status'];
        $task->save();
        return redirect('/');
        return new JsonResponse([
            'message' => 'Задача обновлена у ' .$id
        ]);
    }

    public function changeStatus(Request $request, int $id)
    {
        $task = Task::query()->find($id);
        if ($task->status === Task::STATUS_NO) {
            $task->status = Task::STATUS_YES;
        } else {
            $task->status = Task::STATUS_NO;
        }
        $task->save();
        return redirect('/');
        return new JsonResponse([
            'message' => 'Статус успешно изменён у задачи по номеру' . $id
        ]);
    }
    public function deleteCompleted()
    {
        Task::query()->where('status', '=', 'yes')->delete();
        return redirect('/');
        return new JsonResponse([
            'message' => 'Все выполнненые удалены успешно.'
        ]);
    }
}
