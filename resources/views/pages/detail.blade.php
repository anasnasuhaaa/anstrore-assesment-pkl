@extends('layouts.master')
@section('content')
    <div class="mb-4 shadow-sm rounded-md p-4 bg-white">
        <div class="flex md:flex-row flex-col md:justify-start">
            <img class="md:w-96" src="{{ asset('img/product/' . $product->image) }}" alt="">
            <div class="ml-10 w-full flex justify-between flex-col">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-2xl text-blue-950 font-semibold">{{ $product->name }}</h1>
                        <h1 class="text-3xl text-red-500 font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}
                        </h1>

                    </div>
                    <a href="{{ route('qrcode.download', $product->id) }}">
                        <i class="fa-solid text-blue-950 text-5xl fa-qrcode"></i>
                    </a>
                </div>

                <div>

                    <form action="{{ route('product.checkout', $product->id) }}" method="POST">
                        @csrf
                        <div class="flex flex-col   ">
                            <label for="" class="font-semibold mb-2">Jumlah Pesanan:</label>
                            <input type="number" min="1" required name="qty" class="mb-3 rounded-md">
                            <button type="submit"
                                class="text-white bg-blue-950 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 ">Checkout</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <div class="mb-4 shadow-sm rounded-md p-4 bg-white">
        <div class="p-4">
            <h1 class="font-semibold text-2xl">Deskripsi</h1>
            <hp class="text-lg font-normal">{{ $product->description }}</hp>
        </div>
    </div>
    <div class="shadow-sm rounded-md p-4  bg-white">
        <div class="p-4">
            <h1 class="font-semibold text-2xl">Ulasan</h1>
            @forelse ($review as $item)
                <figure class="max-w-screen-md mt-4 border-b py-2">
                    <div class="flex items-center text-yellow-300 mb-2">
                        @for ($i = 0; $i < $item->rating; $i++)
                            <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                        @endfor

                    </div>
                    <blockquote>
                        <p class="text-lg font-medium text-gray-900 ">"{{ $item->review }}"</p>
                    </blockquote>
                    <figcaption class="flex items-center mt-1 space-x-3 rtl:space-x-reverse">

                        <div class="flex items-center divide-x-2 rtl:divide-x-reverse divide-gray-300 ">
                            <cite class="pe-3 font-medium text-gray-900 ">{{ $item->user->name }}</cite>
                            <cite class="ps-3 text-sm text-gray-500 ">{{ $item->created_at->format('d-m-Y H:i') }}</cite>
                        </div>
                    </figcaption>
                </figure>
            @empty
                Belum ada ulasan
            @endforelse

        </div>
    </div>

    @if (Session::has('notuser-message'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ Session::get('notuser-message') }}",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        </script>
    @endif
    @if (Session::has('message-success-review'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ Session::get('message-success-review') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
@endsection
