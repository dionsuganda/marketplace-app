@extends('website.app')

@section('content')

<main class="flex mt-4 mx-10 h-full">
    
    <div class="flex flex-wrap md:grid md:grid-cols-3 gap-4 mt-6 lg:mt-[45px] lg:mx-[200px] w-full mb-[60px] justify-center">
        @foreach($produk as $key => $valueProduk)
        <div class="w-full text-center max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-center">
            <img class="mt-6 mx-auto rounded-t-lg h-[150px] max-w-[200px]" src="{{ URL::to('/').'/images/'.$valueProduk->image }}" alt="" />
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$valueProduk->nama_produk}}</h5>
                </a>
                <p class="mb-3 font-bold text-red-700 dark:text-gray-400">{{ "Rp " . number_format($valueProduk->harga,0,',','.') }}</p>
                <h5 class="text-xs font-semibold tracking-tight text-gray-400 dark:text-white">{{$valueProduk->stock}} Tersisa 
                <div class="mb-8">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white"></span>
                        </div>
            </div>
            @if($valueProduk->stock <= 0)
            <div class="flex">
                <a href="#" class="w-full px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-b-lg">
                    Stok Habis
                </a>
            </div>
            @else
            <div class="flex">
                <a href="#" data-modal-target="authentication-modal-{{$key}}" data-modal-toggle="authentication-modal-{{$key}}" class="w-full px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-b-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Masukan Ke Keranjang
                </a>
            </div>
            @endif
        </div>

        @if(!Auth::user())
        <!-- Main modal -->
        <div id="authentication-modal-{{$key}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{$key}}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                        <form class="space-y-6" action="{{route('guestLogin')}}" method="post">
                            @csrf
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Login to your account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @else 
        <!-- Main modal -->
        <div id="authentication-modal-{{$key}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal-{{$key}}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <form class="" action="{{route('addToCart',['id' => $valueProduk->id])}}" method="post">
                            @csrf
                            <div class="flex justify-center m-10 text-center">
                                <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex justify-center">
                                    <img class="p-8 rounded-t-lg max-h-[150px] md:max-h-[300px] md:max-w-[500px] drop-shadow-xl" src="{{ URL::to('/').'/images/'.$valueProduk->image }}" alt="product image" />
                                </div>    
                                    <div class="px-5 pb-5">
                                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$valueProduk->nama_produk}}</h5>
                                        <h5 class="text-sm font-semibold tracking-tight text-gray-400 dark:text-white">{{$valueProduk->stock}} Units</h5>
                                        <div class="mb-8">
                                            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ "Rp " . number_format($valueProduk->harga,2,',','.') }}</span>
                                        </div>
                                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Jumlah pembelian: </label>
                                        <div class="w-full flex justify-center">
                                            <input type="number" max="{{$valueProduk->stock}}" id="qty" name="qty" class="w-[100px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500" placeholder="Max. {{$valueProduk->stock}} Pcs" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Masukan Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @endforeach
    </div>

    <!-- <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm pb-10">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Produk
            </header>
        </section>
    </div> -->
</main>
@endsection
