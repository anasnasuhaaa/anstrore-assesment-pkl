<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Order List') }}
            </h2>


        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  text-gray-900">
                    <div class=" mx-auto shadow-md flex justify-start flex-col md:flex-row">
                        <img class="object-cover w-32  rounded-t-lg h-64 md:h-auto md:w-80 md:rounded-none md:rounded-s-lg"
                            src="{{ asset('img/product/' . $order_details->product->image) }}" alt="">
                        <div>
                            <div class="grid grid-cols-4 gap-8">
                                <div>
                                    <h1 class=" text-gray-700">Email: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->user->email }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Nama: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->user->name }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">No HP: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->phone }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Alamat: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->address }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Produk: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">{{ $order_details->product->name }}
                                    </h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Kategori: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->product->category->name }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Harga Satuan: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        Rp{{ number_format($order_details->product->price, 0, ',', '.') }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Stok Tersedia: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->product->stock }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Jumlah Pesanan: </h1>
                                    <h1 class="text-xl text-gray-900 font-medium">
                                        {{ $order_details->qty }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Total Harga: </h1>
                                    <h1 class="text-2xl text-red-600 font-bold">
                                        Rp{{ number_format($order_details->price, 0, ',', '.') }}</h1>
                                </div>
                                <div>
                                    <h1 class=" text-gray-700">Metode Pembayaran: </h1>
                                    <div class="flex">
                                        <img class="w-12 rounded-full"
                                            src="{{ asset('img/payment/' . $order_details->payment->image) }}"
                                            alt="">
                                        <h1 class="text-xl leading-10 ml-4 text-gray-900 font-medium">
                                            {{ $order_details->payment->name }}</h1>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('admin.orderlist.approve', $order_details->id) }}"
                                id="approve-form-{{ $order_details->id }}">
                                @csrf
                                @if ($order_details->order_status == 'dikirim')
                                    <button type="button" disabled
                                        class="mt-4 text-blue-700 w-full  border border-blue-700 0  font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Pesanan
                                        Sedang Dikirim</button>
                                @endif
                                @if ($order_details->order_status == 'pending')
                                    <button type="button" onclick="confirmApprove({{ $order_details->id }})"
                                        class="w-full mt-4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 fon  t-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Approve</button>
                                @endif
                                @if ($order_details->order_status == 'pending')
                                @endif
                            </form>
                        </div>
                    </div>
                    {{-- <form method="GET" action="{{ route('product.index') }}">
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">Kembali</button>
                    </form> --}}

                </div>
            </div>

        </div>
    </div>
    <script>
        function confirmApprove(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Klik Ya jika yakin",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Approve!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Approved!",
                        text: "Pesanan akan dikemas dan dikirim.",
                        showConfirmButton: false,
                        icon: "success"
                    });
                    document.getElementById('approve-form-' + id).submit();
                }
            });
        }
    </script>

</x-app-layout>
