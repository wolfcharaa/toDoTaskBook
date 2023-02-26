<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="{{asset('css/todo.css')}}">
</head>
<body>
<div id="app">
    <section class="todoapp">
        <header>

            <h1>My TODO List</h1>
        </header>
        <form action="api/task" method="post">
            @csrf
            <input type="text" class="new-todo" autofocus placeholder="Создать задачу" name="description">
            <input type="hidden" name="title" value="bla-blla">
            <input type="hidden" name="taskListId" value={{ $taskListObject->id }}>
        </form>

        <main class="main">
            <input id="toggle-all" type="checkbox" class="toggle-all"/>
            <label for="toggle-all"></label>
            <ul class="todo-list">
                @foreach($tasksArray as $task)
                    <li class="todo">
                        <div class="view">
                            <a href="api/task/{{$task->id}}/change_status">
                                @if($task->status === App\Models\Task::STATUS_YES)
                                    <button class="toggle" aria-pressed="true"></button>
                                @else
                                    <button class="toggle" aria-pressed="false"></button>
                                @endif
                                <label for="">{{ $task->description }}</label>
                            </a>
                            <form action="api/task/{{$task->id}}/delete" method="GET">
                                @csrf
                                <button class="destroy"></button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </main>
        <footer class='footer'>
            <span class="todo-count"> <strong>{{ count($tasksArray) }}</strong> items left </span>
            <ul class="filters">
                <li>
                    <a href="/">All</a>
                </li>
                <li>
                    <a href="?status=no">Active</a>
                </li>
                <li>
                    <a href="?status=yes">Completed</a>
                </li>
            </ul>
            <form action="api/task/delete_completed" method="GET">
                <button class="clear-completed">
                    Clear completed
                </button>
            </form>
        </footer>
    </section>
</div>
</body>
</html>
