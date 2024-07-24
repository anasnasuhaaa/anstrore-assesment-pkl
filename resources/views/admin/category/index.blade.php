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
                    <div>
                        <form method="GET" action="{{ route('admin.category.create') }}">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah
                                Kategori</button>
                        </form>
                    </div>


                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <table class="w-full border-2 border-gray-100 text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-4 py-4">
                                        No
                                    </th>
                                    <th scope="col" class="px-4 py-4">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-4 py-4 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($category as $key => $value)
                                    <tr class="bg-white border-b ">
                                        <td scope="row"
                                            class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $key + 1 }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $value->name }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center items-center">
                                                <a href="/admin/category/{{ $value->id }}/edit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Edit</a>
                                                <form method="POST" action="/admin/category/{{ $value->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 ">
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    Kategori Masih Kosong
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
