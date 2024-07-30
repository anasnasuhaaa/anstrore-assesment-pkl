@extends('layouts.master')
@section('content')
    <div>
        <img class="rounded-md" src="{{ asset('img/logo/baner.png') }}" alt="">
    </div>

    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
        <button type="button"
            class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 ">All
            categories</button>
        @foreach ($categories as $item)
            <a type="button"
                class="text-gray-900 border border-white hover:border-gray-200  bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 ">{{ $item->name }}</a>
        @endforeach

    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 place-items-center lg:grid-cols-4 gap-4">
        @foreach ($products as $item)
            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow hover:border-2 hover:border-blue-700 transition-all">
                <a href="{{ route('product.detail', $item->id) }}">
                    <img class="p-4 rounded-t-lg w-full" src="{{ asset('img/product/' . $item->image) }}"
                        alt="product image" />
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 ">
                            {{ Str::limit($item->name, 15, '...') }}</h5>
                    </a>
                    <div class="flex">
                        <i class="fa-solid fa-tag text-blue-800 pt-1"></i>
                        <p class="text-black ml-3">{{ $item->category->name }}</p>
                    </div>
                    <div class="flex items-center mt-2.5 mb-5">
                        <span
                            class="bg-yellow-400 text-black text-sm font-semibold px-2.5 py-0.5 rounded ">{{ $item->average_rating }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-blue-900 ">Rp{{ number_format($item->price, 0, ',', '.') }}</h1>

                </div>
            </div>
        @endforeach

    </div>
@endsection
