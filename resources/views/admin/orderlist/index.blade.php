<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Order List') }}
            </h2>
            <a href="{{ route('download.excel') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Download
                Excel</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order Status
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
                                        <td class="px-6 py-4">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->user->email }}
                                        </td>

                                        <td class="px-6 py-4">
                                            $2999
                                        </td>
                                        @if ($item->order_status == 'pending')
                                            <td class="px-6 py-4 ">
                                                <p
                                                    class="rounded-md border-2 w-fit p-2  text-center border-yellow-500 text-yellow-500">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif
                                        @if ($item->order_status == 'dikirim')
                                            <td class="px-6 py-4 ">
                                                <p
                                                    class="rounded-md border-2 w-fit p-2  text-center border-red-500 text-white">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif
                                        @if ($item->order_status == 'dikirim')
                                            <td class="px-6 py-4 ">
                                                <p
                                                    class="rounded-md border-2 w-fit p-2  text-center border-green-500 text-green-500">
                                                    {{ $item->order_status }}
                                                </p>
                                            </td>
                                        @endif
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.orderlist.show', $item->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
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
