@extends('layouts.master')
@section('content')
    <div class="py-4">
        <div class=" mx-auto sm:px-6 lg:px-8">
            {{ $order_details->links() }}
            <div class="bg-white mt-2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-50 uppercase bg-blue-950">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Gambar
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 mx-auto text-center">
                                        Status Pesanan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $i => $item)
                                    <tr class="odd:bg-white  even:bg-gray-100 ">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ ++$i }}
                                        </th>
                                        <td class="px-6 py-4 text-gray-700">
                                            <img src="{{ asset('img/product/' . $item->product_image) }}" class="w-16"
                                                alt="{{ $item->product_name }}">
                                        </td>
                                        <td class="px-6 py-4 text-gray-700   ">
                                            {{ Str::limit($item->product_name, 15, '...') }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-700">
                                            {{ $item->created_at->format('d-m-Y H:i') }}
                                        </td>
                                        @if ($item->order_status == 'pending')
                                            <td class="px-6 py-4rtext-gray-700">
                                                <p
                                                    class="rounded-md border-2 w-fit py-1 mx-auto px-2  text-center border-yellow-500 text-yellow-500">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif
                                        @if ($item->order_status == 'dikirim')
                                            <td class="px-6 py-4rtext-gray-700">
                                                <p
                                                    class="rounded-md border-2 w-fit py-1 mx-auto px-2  text-center border-blue-500 text-blue-500">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif
                                        @if ($item->order_status == 'diterima')
                                            <td class="px-6 py-4rtext-gray-700">
                                                <p
                                                    class="rounded-md border-2 w-fit py-1 mx-auto px-2  text-center border-green-500 text-green-500">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif

                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('user.orderlist.show', $item->id) }}"
                                                class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ">Detail</a>
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
@endsection
