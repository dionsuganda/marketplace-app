<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ModuleController;

use Validator;
use Redirect;
use NumberFormatter;

class ProductController extends Controller
{
    protected $eloquentTask;
    public function __construct(ModuleController $eloquentTask)
    {
        $this->eloquentTask = $eloquentTask;
        $this->middleware('auth');
    }

    public function index(){

        return view('admin/createProduct');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga' => 'required',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $int = (int) filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);

        $imageName = time().'.'.$request->image->extension(); 
        $request->image->move(public_path('images'), $imageName);
        $dataInsert = [
            'nama_produk' => $request->nama_produk,
            'harga' => $int,
            'stock' => $request->stock,
            'image' => $imageName,
        ];
        $addProduk = $this->eloquentTask->insertTasks('tbl_produk', $dataInsert);

        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return redirect()->route('home', ['produk' => $produk, 'message' => 'Successfully added data.', 'alert' => null]);
    }

    public function delete($id)
    {
        $addProduk = $this->eloquentTask->deleteTasks('tbl_produk', $id);
        $produk = $this->eloquentTask->getTasks('tbl_produk');
        if(!$addProduk){
            return redirect()->route('home', ['produk' => $produk, 'message' => null, 'alert' => 'Failed to delete data.']);
            // return view('home', ['produk' => $produk, 'message' => null, 'alert' => 'Failed to delete data.']);
        }
        return redirect()->route('home', ['produk' => $produk, 'message' => 'Successfully deleted data.', 'alert' => null]);
        // return view('home', ['produk' => $produk, 'message' => 'Successfully deleted data.', 'alert' => null]);
    }

    public function detail($id)
    {
        $getProduk = $this->eloquentTask->getTasksById('tbl_produk', $id);
        // dd($getProduk);
        return view('admin/detailProduct', ['data' => $getProduk]);
    }

    public function updateView(Request $request, $id)
    {
        $getProduk = $this->eloquentTask->getTasksById('tbl_produk', $id);
        $getProduk->harga = "Rp " . number_format($getProduk->harga,0,'','.');
        return view('admin/updateProduct', ['data' => $getProduk]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'harga' => 'required',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $int = (int) filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);

        if(isset($request->image)){
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('images'), $imageName);
            $dataInsert = [
                'nama_produk' => $request->nama_produk,
                'harga' => $int,
                'stock' => $request->stock,
                'image' => $imageName,
            ];
        }else{
            $dataInsert = [
                'nama_produk' => $request->nama_produk,
                'harga' => $int,
                'stock' => $request->stock,
            ];
        }
        $addProduk = $this->eloquentTask->updateTasks('tbl_produk', $dataInsert, $id);

        $produk = $this->eloquentTask->getTasks('tbl_produk');
        return redirect()->route('home', ['produk' => $produk, 'message' => 'Successfully updated data.', 'alert' => null]);
    }
}
