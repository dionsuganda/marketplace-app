@extends('website.app')

@section('content')

<main class="flex flex-col lg:mx-[200px] mt-10 mx-10 h-full justify-center">
       
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-red-200 uppercase bg-red-700 dark:bg-red-700 dark:text-red-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Produk
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kuantitas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Harga Keseluruhan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; ?>
                @if($cart)
                @foreach($cart as $key => $valueCart)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$valueCart->nama_produk}}
                    </th>
                    <td class="px-6 py-4">
                    {{$valueCart->qty}}
                    </td>
                    <td class="px-6 py-4">
                    {{ "Rp " . number_format($valueCart->harga,0,',','.') }}
                    </td>
                    <td class="px-6 py-4">
                    {{ "Rp " . number_format($valueCart->harga * $valueCart->qty,0,',','.') }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#" data-modal-target="popup-modal-{{$valueCart->id}}" data-modal-toggle="popup-modal-{{$valueCart->id}}"  class="bg-red-300 hover:bg-red-400 text-red-700 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Hapus</a>
                    </td>
                </tr>
                    <!-- Modal Hapus -->
                    <div id="popup-modal-{{$valueCart->id}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal-{{$valueCart->id}}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                <form action="{{ route('deleteCart', ['id' => $valueCart->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" data-modal-hide="popup-modal-{{$valueCart->id}}" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, I'm sure
                                    </button>
                                </form>
                                <button data-modal-hide="popup-modal-{{$valueCart->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                            </div>
                        </div>
                    </div>
                    <?php $total += $valueCart->harga * $valueCart->qty ?>
                @endforeach
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th colspan="3" scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                        Total Keseluruhan
                    </th>
                    <td class="font-bold px-6 py-4">
                        {{ "Rp " . number_format($total,0,',','.') }}
                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th colspan="5" scope="row" class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Keranjang anda kosong
                    </th>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th colspan="3" scope="row" class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white">
                        Total Keseluruhan
                    </th>
                    <td class="font-bold px-6 py-4">
                    {{ "Rp " . number_format(0,0,',','.') }}
                    </td>
                    <td class="px-6 py-4">
                    </td>
                </tr>
                @endif
                
            </tbody>
        </table>
    </div>
    <div class="flex justify-center sm:justify-end mt-6">
        <a href="{{route('guestIndex')}}" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Belanja Kembali</a>
        <button data-modal-target="popup-modal-checkout" data-modal-toggle="popup-modal-checkout" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Checkout</button>
    </div>

    <!-- Modal Checkout -->
    <div id="popup-modal-checkout" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal-checkout">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to <a class="text-red-700">checkout</a> this product?</h3>
                    <form action="{{ route('checkoutCart') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="data" value="{{ $cart }}">
                        <button type="submit" data-modal-hide="popup-modal-checkout" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="popup-modal-checkout" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
</main>
@endsection
