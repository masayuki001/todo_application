<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        // すべてのフォルダを取得する
        $folders = Folder::all();
    
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
    
        // 選ばれたフォルダに紐づくタスクを取得する
        // get()がrailsと違って必要。これ忘れないように。因みにクエリ文字列取得はtoSql()
        $tasks = Task::where('folder_id', $current_folder->id)->get();
    
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * GET /folders/{id}/tasks/new
     */
    public function new(int $id)
    {
        return view('tasks/new', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    /**
     * GET /folders/{id}/tasks/{task_id}/edit
     */
    public function edit(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * POST /folders/{id}/tasks/{task_id}/update
     */
    public function update(int $id, int $task_id, EditTask $request)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
