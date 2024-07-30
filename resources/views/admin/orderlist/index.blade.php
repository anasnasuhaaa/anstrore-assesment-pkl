<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Order List') }}
            </h2>

            <a href="{{ route('download.excel') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <i class="fa-regular fa-file-excel"></i> Download Excel</a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ $order_details->links() }}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 mx-auto text-center">
                                        Order Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $i => $item)
                                    <tr class="odd:bg-white  even:bg-gray-100 ">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ ++$i }}
                                        </th>
                                        <td class="px-6 py-4 text-gray-700">
                                            {{ $item->user->email }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-700   ">
                                            {{ Str::limit($item->product->name, 10, '...') }}
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
                                            <a href="{{ route('admin.orderlist.show', $item->id) }}"
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


</x-app-layout>
