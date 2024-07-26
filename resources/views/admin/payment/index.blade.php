<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold leading-10 text-xl text-gray-800">
                {{ __('Manage Payment Method') }}
            </h2>
            <form method="GET" action="{{ route('payment.create') }}">
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
                    <div class="relative overflow-x-auto ">
                        <table class="w-full  text-sm text-left rtl:text-right text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-4 py-4">
                                        No
                                    </th>
                                    <th scope="col" class="text-center px-4 py-4">
                                        logo
                                    </th>
                                    <th scope="col" class=" px-10 py-4">
                                        Metode Pembayaran
                                    </th>
                                    <th scope="col" class="px-4 py-4 text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($category as $key => $value) --}}
                                @foreach ($payment as $key => $item)
                                    <tr class="bg-white border-b ">

                                        <td scope="row"
                                            class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ ++$key }}
                                        </td>
                                        <td scope="row"
                                            class=" px-4 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            <img class="w-20 mx-auto rounded-full aspect-square object-cover"
                                                src="{{ asset('img/payment/' . $item->image) }}" alt="logo" />
                                        </td>
                                        <td scope="row"
                                            class=" px-10 py-4 text-md font-semibold text-gray-900 whitespace-nowrap ">
                                            {{ $item->name }}
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-center items-center">
                                                <a href="{{ route('payment.edit', $item->id) }}"
                                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2  ">Edit</a>

                                                <form method="POST" action="{{ route('payment.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 ">
                                                        Delete</button>
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
