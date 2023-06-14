@extends('admin.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm">

            <header class="font-semibold bg-gradient-to-t from-blue-700 to-blue-900 text-gray-200 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Detail Produk
            </header>
            
            <div class="flex justify-center m-10 text-center">
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-center">
                    <img class="p-8 rounded-t-lg max-h-[250px] md:max-h-[500px] md:max-w-[500px] drop-shadow-xl" src="{{ URL::to('/').'/images/'.$data->image }}" alt="product image" />
                </div>    
                    <div class="px-5 pb-5">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$data->nama_produk}}</h5>
                        <h5 class="text-sm font-semibold tracking-tight text-gray-400 dark:text-white">{{$data->stock}} Units</h5>
                        <div class="mb-8">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp " . number_format($data->harga,2,',','.') }}</span>
                        </div>
                        <a href="{{route('home')}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-4 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</a>
                    </div>
                </div>
            </div>

        </section>
    </div>
</main>
@endsection