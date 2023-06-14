<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

use App\Http\Controllers\ModuleController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $eloquentTask;
    public function __construct(ModuleController $eloquentTask)
    {
        $this->eloquentTask = $eloquentTask;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = $request->input('message');
        $alert = $request->input('alert');
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return view('home', ['produk' => $produk, 'message' => $message, 'alert' => $alert]);
    }
}
