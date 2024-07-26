<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  text-gray-900">
                    <div class=" max-w-xl mx-auto shadow-md flex justify-start flex-col md:flex-row">
                        <img class="object-cover w-32  rounded-t-lg h-64 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"
                            src="{{ asset('img/product/' . $product->image) }}" alt="">
                        <div class="flex flex-col justify-between p-4  leading-normal">
                            <h5 class="mb-2 text-xl bg-blue-300 p-2 rounded-md font-bold tracking-tight text-gray-900 ">
                                {{ $product->category->name }}</h5>
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ $product->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700">{{ $product->description }}</p>
                            <div class="flex justify-between">
                                <p class="mb-3 font-normal text-gray-700">{{ $product->price }}</p>
                                <p class="mb-3 font-normal text-gray-700">{{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                    <form method="GET" action="{{ route('product.index') }}">
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Kembali</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
