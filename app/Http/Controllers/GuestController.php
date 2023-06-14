<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use Validator;
use Redirect;
use Session;


class GuestController extends Controller
{
    protected $eloquentTask;
    public function __construct(ModuleController $eloquentTask)
    {
        $this->eloquentTask = $eloquentTask;
    }
    
    public function index()
    {
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return view('website/landingPage', ['produk' => $produk]);
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'confirmed'],
            'phone' => ['required', 'digits_between:11,15'],
            'address' => ['required', 'string'],
        ]);

        if($validation->fails()) {
            return Redirect::back()->withErrors($validation);
        }

        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'access' => '1',
        ];

        $addProduk = $this->eloquentTask->insertTasks('Users', $dataInsert);
        if(!$addProduk){
            return "<script LANGUAGE='JavaScript'> window.alert('Somthing Failed.'); window.location.href='".URL::previous()."'; </script>";
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'access' => '1'])) {
            $request->session()->regenerate();
 
            $produk = $this->eloquentTask->getTasks('tbl_produk');
            return redirect()->route('guestIndex', ['produk' => $produk]);
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function login(Request $request){

        // Auth::logout();
        // Session::flush();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'access' => '1'])) {
            $request->session()->regenerate();
 
            $produk = $this->eloquentTask->getTasks('tbl_produk');
            return redirect()->route('guestIndex', ['produk' => $produk]);
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return redirect()->route('guestIndex', ['produk' => $produk, 'user' => Auth::user()]);
    }
}
