@extends('layouts.app')

@section('content')
    <div class=" max-w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-2 p-10 lg:p-10 mb-5 lg:mt-10">
        <div class="bg-white text-center py-2 text-lg font-bold">
            MASTER DATA PIUTANG
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($columns as $title => $items)
                    <div>
                        <h3 class="font-semibold mb-2 text-center bg-gray-100 py-1">{{ $title }}</h3>
                        <ul class="space-y-1">
                            @foreach ($items as $item)
                                <li class="flex items-center">
                                    <span class="mr-2">
                                        <a href="#">
                                            <div class="text-red-500 hover:scale-110 active:scale-90">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"/>
                                                </svg>
                                            </div>
                                        </a>
                                    </span>
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
            <div class="flex justify-center gap-4 mt-4">
                <button class="inline-flex items-center justify-center w-full lg:w-auto active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-6 py-2 bg-[#0F8114]">
                    Simpan
                </button>
                <button class="inline-flex items-center justify-center w-full lg:w-auto active:scale-[.95] hover:bg-white hover:text-red-700 transition-all text-white border-2 bg-red-700 hover:text-red-700 border-red-700 py-2 px-6 rounded-md shadow-sm font-medium">
                    Batal
                </button>
            </div>            
        </div>
    </div>
@endsection
