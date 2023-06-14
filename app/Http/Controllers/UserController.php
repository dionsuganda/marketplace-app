<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Keranjang;


use Validator;
use Redirect;
use Session;


class UserController extends Controller
{
    protected $eloquentTask;
    public function __construct(ModuleController $eloquentTask)
    {
        $this->eloquentTask = $eloquentTask;
        $this->middleware('auth');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return redirect()->route('guestIndex', ['produk' => $produk]);
    }

    public function addToCart(Request $request, $id)
    {
        $produkData = $this->eloquentTask->getTasksById('tbl_produk', $id);
        if($request->input('qty') > $produkData->stock || $request->input('qty') == 0){
            return "<script LANGUAGE='JavaScript'> window.alert('Kuantiti tidak sesuai.'); window.location.href='".URL::previous()."'; </script>";
        }

        $dataInsert = [
            'id_user' => Auth::user()->id,
            'id_product' => $id,
            'qty' => $request->qty,
        ];

        $addProduk = $this->eloquentTask->insertTasks('tbl_keranjang', $dataInsert);
        if(!$addProduk){
            return "<script LANGUAGE='JavaScript'> window.alert('Somthing Failed.'); window.location.href='".URL::previous()."'; </script>";
        }
        $dataUpdate = [
            'stock' => $produkData->stock - $request->qty,
        ];
        $updateStok = $this->eloquentTask->updateTasks('tbl_produk', $dataUpdate, $id);
        if(!$updateStok){
            return "<script LANGUAGE='JavaScript'> window.alert('Failed update stok.'); window.location.href='".URL::previous()."'; </script>";
        }
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return redirect()->route('guestIndex', ['produk' => $produk]);
    }

    public function listCart(){
        $cart = DB::table('tbl_keranjang')
        ->join('tbl_produk', 'tbl_keranjang.id_product', '=', 'tbl_produk.id')
        ->where('id_user', Auth::user()->id)
        ->where('status_checkout', 'Tidak')
        ->select('tbl_keranjang.*', 'tbl_produk.id as id_produk', 'tbl_produk.nama_produk', 'tbl_produk.image', 'tbl_produk.harga', 'tbl_produk.stock')
        ->get();
        return view('website/keranjangPage', ['cart' => $cart]);
    }
    
    public function deleteCart($id){
        $cart = DB::table('tbl_keranjang')
        ->where('id', $id)
        ->first();
        
        $produkOld = DB::table('tbl_produk')
        ->where('id', $cart->id_product)
        ->first();

        $cartDelete = DB::table('tbl_keranjang')
        ->where('id', $id)
        ->delete();

        $produk = DB::table('tbl_produk')
        ->where('id', $cart->id_product)
        ->update([
            'stock' => $produkOld->stock + $cart->qty,
        ]);
        return redirect()->route('guestIndex');
    }

    public function checkout(Request $request){
        $data = json_decode($request->data);
        foreach($data as $key => $value){
            $dataUpdate = [
                'status_checkout' => 'Ya',
            ];
            $updateStok = $this->eloquentTask->updateTasks('tbl_keranjang', $dataUpdate, $value->id);
        }

        return redirect()->route('listCart');
    }

}
