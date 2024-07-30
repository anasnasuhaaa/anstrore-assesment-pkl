<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Payment Method') }}
            </h2>
            <form method="GET" action="{{ route('admin.payment.create') }}">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Add
                    New +</button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-4">No</th>
                                    <th scope="col" class="text-center px-4 py-4">Logo</th>
                                    <th scope="col" class="px-10 py-4">Metode Pembayaran</th>
                                    <th scope="col" class="px-4 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payment as $key => $item)
                                    <tr class="bg-white border-b">
                                        <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ ++$key }}
                                        </td>
                                        <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <img class="w-20 mx-auto rounded-full aspect-square object-cover"
                                                src="{{ asset('img/payment/' . $item->image) }}" alt="logo" />
                                        </td>
                                        <td class="px-10 py-4 text-md font-semibold text-gray-900 whitespace-nowrap">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center items-center">
                                                <a href="{{ route('admin.payment.edit', $item->id) }}"
                                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2">Edit</a>
                                                <button onclick="confirmDeletion({{ $item->id }})"
                                                    class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2">
                                                    Delete
                                                </button>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.payment.destroy', $item->id) }}"
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
