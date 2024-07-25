<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <form method="GET" action="{{ route('product.create') }}">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Tambah
                                Produk</button>
                        </form>
                    </div>

                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <table class="w-full border-2 border-gray-100 text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Nama Produk
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Kategori
                                    </th>
                                    <th scope="col" class="text-center px-4 py-3">
                                        Gambar
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Stok
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Harga Satuan
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $index => $item)
                                    <tr class="bg-white border-b ">
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $index + 1 }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->name }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->category->name }}
                                        </td>
                                        <td scope="row"
                                            class="flex justify-center items-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            <img class="w-14 aspect-square object-cover"
                                                src="{{ asset('img/' . $item->image) }}" alt="">
                                        </td>
                                        <td scope="row"
                                            class= "text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->stock }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-center items-center">
                                                <a href="/admin/product/{{ $item->id }}"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Detail</a>
                                                <a href="/admin/product/{{ $item->id }}/edit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Edit</a>

                                                <form method="POST" action="/admin/product/{{ $item->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 ">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
