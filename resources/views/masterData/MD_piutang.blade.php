@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-gray-200 text-center py-2 text-lg font-bold">
            MASTER DATA PIUTANG
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($columns as $title => $items)
                    <div>
                        <h3 class="font-semibold mb-2 text-center bg-gray-100 py-1">{{ $title }}</h3>
                        <ul class="space-y-1">
                            @foreach ($items as $item)
                                <li class="flex items-center">
                                    <span class="mr-2">=</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                            <li class="italic text-gray-600">
                                <a href="{{ route('master_data_piutang_create', ['header' => $title]) }}">Tambahkan baru</a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 flex justify-center space-x-4">
                <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if (request()->has('header'))
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambahkan Item Baru
                                </h3>
                                <div class="mt-2">
                                    <form id="addItemForm" method="POST"
                                        action="{{ request('header') === 'Tipe Piutang' ? route('storeTipePiutang') : route('storeTipePelanggan') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="headerName" class="block text-sm font-medium text-gray-700">Nama
                                                Item</label>
                                            <input type="text" name="headerName" id="headerName"
                                                value="{{ request('header') }}"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                                required readonly>
                                        </div>

                                        <!-- Conditionally add the 'kode' input field when the header is 'Tipe Piutang' -->
                                        @if (request('header') === 'Tipe Piutang')
                                            <div class="mb-4">
                                                <label for="kode"
                                                    class="block text-sm font-medium text-gray-700">Kode</label>
                                                <input type="text" name="kode" id="kode"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                                    required>
                                            </div>
                                        @endif

                                        <div class="mb-4">
                                            <label for="itemType" class="block text-sm font-medium text-gray-700">Nama
                                                Tipe</label>
                                            <input type="text" name="typeName" id="itemType"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                                required>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" form="addItemForm"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 sm:ml-3 sm:w-auto sm:text-sm">Tambahkan</button>
                        <a href="{{ route('master_data_piutang') }}"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
