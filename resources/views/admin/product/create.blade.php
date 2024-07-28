<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="mx-auto" action="{{ route('product.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Nama Produk</label>
                            <input type="text" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        @error('name')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Kategori</label>
                            <select name="category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="" selected disabled>--Pilih Kategori--</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Gambar Produk</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none p-2.5"
                                type="file" name="image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        @error('image')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi</label>
                            <textarea name="description" rows="5"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </textarea>
                        </div>
                        @error('description')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Harga</label>
                            <input type="number" name="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        @error('price')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Stok</label>
                            <input type="number" name="stock"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                        </div>
                        @error('stock')
                            <div class="alert text-red-500 alert-danger">{{ $message }}</div>
                        @enderror

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
