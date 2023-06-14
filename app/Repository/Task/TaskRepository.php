<?php
namespace App\Repository\Task;

use Illuminate\Http\Request;


interface TaskRepository
{
    public function createTask(Request $request);
    public function getTasks($table);
    public function getTasksById($id);
    public function updateTask(Request $request, $id);
    public function setAsFinish($id);
}