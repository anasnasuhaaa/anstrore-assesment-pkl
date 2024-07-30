@extends('layouts.master')
@section('content')
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  text-gray-900">
                    <div class=" mx-auto shadow-md flex justify-between flex-col md:flex-row">
                        <img class="object-contain aspect-square mr-2  w-[100%]  rounded-t-lg h-64 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"
                            src="{{ asset('img/product/' . $order_details->product->image) }}" alt="">
                        <div class="w-full pb-4 md:w-[80%]">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h1 class=" text-gray-700">Email: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->user->email }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Nama: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->user->name }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">No HP: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->phone }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Alamat: </h1>
                                    <h1 class="text-md text-gray-900 font-medium">{{ $order_details->address }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Produk: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->product->name }}
                                    </h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Kategori: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->product->category->name }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Harga Satuan: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        Rp{{ number_format($order_details->product->price, 0, ',', '.') }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Stok Tersedia: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->product->stock }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Jumlah Pesanan: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->qty }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Total Harga: </h1>
                                    <h1 class="text-2xl text-red-600 font-bold">
                                        Rp{{ number_format($order_details->price, 0, ',', '.') }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Metode Pembayaran: </h1>
                                    <div class="flex">
                                        <img class="w-12 rounded-full"
                                            src="{{ asset('img/payment/' . $order_details->payment->image) }}"
                                            alt="">
                                        <h1 class="text-xl leading-10 ml-4 text-gray-900 font-medium">
                                            {{ $order_details->payment->name }}</h1>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('order.arrived', $order_details->id) }}"
                                id="confirm-form-{{ $order_details->id }}">
                                @csrf
                                @if ($order_details->order_status == 'diterima')
                                    <button type="button" disabled
                                        class="mt-4 text-green-600 border-2 border-green-600 w-full  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Pesanan
                                        Telah
                                        Diterima</button>
                                    <div class=" flex  justify-stretch">
                                        <a href="{{ route('user.orderlist.review', $order_details->product->id) }}"
                                            class=" text-white bg-blue-600 w-full hover:bg-blue-700  border-2 border-blue-600   font-medium rounded-lg text-sm px-5 py-2.5 text-center  mb-2 ">Beri
                                            Ulasan</a>
                                    </div>
                                @endif
                                @if ($order_details->order_status == 'pending')
                                    <button type="button" disabled
                                        class="mt-4 text-yellow-600 w-full  border-2 border-yellow-600   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                                        Menunggu Konfirmasi Admin</button>
                                @endif
                                @if ($order_details->order_status == 'dikirim')
                                    <button type="button" disabled
                                        class="mt-4 cursor-text text-blue-600 w-full  border-2 border-blue-600   font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Pesanan
                                        Sedang Dikirim</button>
                                    <button type="button" onclick="confirmOrderArrived({{ $order_details->id }})"
                                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 fon  t-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Konfirmasi
                                        Pesanan
                                        Diterima</button>
                                    <input type="hidden" name="id" value="{{ $order_details->id }}">
                                @endif
                            </form>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <script>
        function confirmOrderArrived(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Untuk mengonformasi bahwa pesanan ini telah diterima",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Confirmed!",
                        text: "Pesanan telah diterima",
                        icon: "success"
                    });
                    document.getElementById('confirm-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
