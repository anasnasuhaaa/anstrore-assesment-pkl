@extends('layouts.master')
@section('content')
    <div class="mb-8 shadow-sm rounded-md p-4 bg-white">
        <div class="flex md:flex-row flex-col">
            <img class="md:w-96" src="{{ asset('img/product/' . $product->image) }}" alt="">
            <div>
                <h1 class="text-2xl text-blue-950 font-semibold">{{ $product->name }}</h1>
                <h1 class="text-3xl text-red-500 font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</h1>
                <a href="{{ route('qrcode.download', $product->id) }}">
                    <i class="fa-solid text-blue-950 text-5xl fa-qrcode"></i>
                </a>
                <div>

                    <form action="{{ route('product.checkout', $product->id) }}" method="POST">
                        @csrf
                        <label for="">jumlah pesanan</label>
                        <input type="number" min="1" required name="qty">
                        <button type="submit"
                            class="text-white bg-blue-950 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Checkout</button>
                    </form>
                    {{-- <a href="{{ route('checkout', $product->id) }}" type="submit"
                        class="text-white bg-blue-950 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Checkout</a> --}}

                </div>
            </div>

        </div>
    </div>
    <div class="mb-8 shadow-sm rounded-md p-4 bg-white">
        <div class="p-4">
            <h1 class="font-semibold text-2xl">Description</h1>
            <hp class="text-lg font-normal">{{ $product->description }}</hp>
        </div>
    </div>
    <div class="shadow-sm rounded-md p-4 bg-white">
        <div class="p-4">
            <h1 class="font-semibold text-2xl">Reviews</h1>
            <hp class="text-lg font-normal">Masih Kosong</hp>
        </div>
    </div>
@endsection
