<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function getTasks($table)
    {
        $task = DB::table($table)->get();
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function getTasksById($table, $id)
    {
        $task = DB::table($table)->where('id', $id)->first();
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function getTasksByUser($table)
    {
        $task = DB::table($table)->where('id_user', Auth::user()->id)->get();
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function insertTasks($table, $value)
    {
        if(!is_array($value)){
            return false;
        }
        $task = DB::table($table)->insert($value);
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function deleteTasks($table, $id)
    {
        if($id == null){
            return false;
        }
        $task = DB::table($table)->where('id', $id)->delete();
        if ($task != null) {
            return $task;
        }
        return null;
    }

    public function updateTasks($table, $data, $id)
    {
        if($id == null){
            return false;
        }
        $task = DB::table($table)->where('id', $id)->update($data);
        if ($task != null) {
            return $task;
        }
        return null;
    }
}
