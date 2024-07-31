<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl leading-10 text-gray-800">
                {{ __('Manage Products') }}
            </h2>

            <form method="GET" action="{{ route('admin.product.create') }}">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  ">Add
                    New Product</button>
                <a href="{{ route('product.excel') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <i class="fa-regular fa-file-excel"></i> Download Excel</a>
            </form>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $products->links() }}
            <div class="bg-white mt-2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="relative overflow-x-auto shadow-sm ">
                        <table class="w-full  border-gray-100 text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100 ">
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="text-center px-4 py-3">
                                        Gambar
                                    </th>
                                    <th scope="col" class="text-center px-4 py-3">
                                        QR CODE
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Nama Produk
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Kategori
                                    </th>

                                    <th scope="col" class="px-4 py-3 text-center">
                                        Stok
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $item)
                                    <tr class="bg-white border-b ">
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $index + 1 }}
                                        </td>

                                        <td scope="row"
                                            class="flex justify-center items-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            <img class="w-10  aspect-square object-cover"
                                                src="{{ asset('img/product/' . $item->image) }}" alt="">
                                        </td>


                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            <img class="w-10 mx-auto"
                                                src="{{ asset('img/qrcodes/' . $item->qrcode_file) }}" alt="">
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ Str::limit($item->name, 10, '...') }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->category_name }}
                                        </td>
                                        <td scope="row"
                                            class= "text-center px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->stock }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $item->created_at->format('d-m-Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-center items-center">
                                                <a href="/admin/product/{{ $item->id }}"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Detail</a>
                                                <a href="/admin/product/{{ $item->id }}/edit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Edit</a>

                                                <button onclick="confirmDeletion({{ $item->id }})"
                                                    class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2">
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.product.destroy', $item->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
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
    @if (Session::has('success-added'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ Session::get('success-added') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if (Session::has('success-deleted'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ Session::get('success-deleted') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <script>
        function confirmDeletion(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>
