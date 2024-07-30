@extends('layouts.master')
@section('content')
    <div class="bg-white">
        <div class="max-w-xl mx-auto p-4">
            <div class="flex items-center">
                <img src="{{ asset('img/product/' . $product->image) }}" alt="">
                <div>
                    <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>
                </div>
            </div>
            <form class="mx-auto" method="POST" action="{{ route('review.store', $product->id) }}">
                @csrf
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Rating <i
                            class="fa-solid fa-star text-yellow-400"></i> 1-5</label>
                    <input type="number" min="1" max="5" id="email" name="rating"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Ulasan</label>
                    <textarea rows="5" name="review"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full "></textarea>
                </div>
                <div class="flex justify-stretch">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                </div>
            </form>

        </div>

    </div>
@endsection
