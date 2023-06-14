<?php

namespace App\Repository\Task;
use App\Repository\Task\TaskRepository;

class EloquentTaskRepository implements TaskRepository
{
    public function getTasks($table)
    {
        $task = DB::table($table)->get();
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function updateTask(Request $request, $id)
    {
       $task = Task::whereId($id)->first();
        if ($task != null) {
            $task->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return $task;
        }
        return null;
    }
}