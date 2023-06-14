<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

class CobaController extends Controller
{
    //
    public function listUser()
    {
        return Datatables::of(User::all())->make(true);
    }
}
