@extends('layouts.master')
@section('content')
    <div class="flex flex-col md:flex-row p-6 bg-white shadow-sm">
        <img class="object-contain w-96 aspect-square" src="{{ asset('img/product/' . $product->image) }}" alt="">
        <form class="min-w-md mx-auto" action="{{ route('checkout.store', $product->id) }}" method="POST"
            id="confirm-form-{{ $product->id }}">
            @csrf
            <div class="relative z-0 w-96 mb-5 group">
                <input type="text" name="address"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label
                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" inputmode="numeric" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="floating_phone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                    number</label>
            </div>
            <label class="text-gray-500 text-sm">Metode Pembayaran</label>
            <div class="payment-method grid grid-cols-2 gap-2 mt-2 mb-2">
                @foreach ($payment as $item)
                    <div class="flex items-center border border-gray-200 rounded ">
                        <img src="{{ asset('img/payment/' . $item->image) }}" class="w-10 mr-2" alt="">
                        <input id="bordered-radio-1" type="radio" value="{{ $item->id }}" name="payment"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 ">
                        <label for="bordered-radio-1"
                            class="w-full  ms-2 text-sm font-medium text-gray-500 ">{{ $item->name }}</label>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="qty" value="{{ $qty }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <div>
                <h1>Harga: Rp{{ number_format($price, 0, ',', '.') }}</h1>
                <h1>Kuantiti: {{ $qty }}</h1>
                <h1 class="text-xl font-semibold text-red-600">Total: {{ number_format($total, 0, ',', '.') }}</h1>
            </div>

            <button type="button" onclick="confirmCheckout({{ $product->id }})"
                class="text-white mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Pesan</button>
        </form>
    </div>
    <script>
        function confirmCheckout(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Akan memesan produk ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Pesanan telah dipesan",
                        icon: "success"
                    });
                    document.getElementById('confirm-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
