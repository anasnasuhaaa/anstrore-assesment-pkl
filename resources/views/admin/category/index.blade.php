<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Categories') }}
            </h2>
            <form method="GET" action="{{ route('admin.category.create') }}">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Add
                    New +</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">



                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <table class="w-full border-2 border-gray-100 text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-4 py-4">
                                        No
                                    </th>
                                    <th scope="col" class="text-center px-4 py-4">
                                        logo
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
                                            <img class="w-20 rounded-full mx-auto aspect-square object-fill"
                                                src="{{ asset('img/category/' . $value->image) }}" alt="" />
                                        </td>
                                        <td scope="row"
                                            class="px-4 py-4 font-semibold text-md text-gray-900 whitespace-nowrap ">
                                            {{ $value->name }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center items-center">
                                                <a href="/admin/category/{{ $value->id }}/edit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Edit</a>

                                                <button onclick="confirmDeletion({{ $value->id }})"
                                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2">
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $value->id }}"
                                                    action="/admin/category/{{ $value->id }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('delete')
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
