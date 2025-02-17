@extends('layouts.app')

@section('content')
    <div class=" max-w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden p-10 lg:p-7 mb-5 mt-10 lg:mt-20">
        <div class="text-2xl font-bold mb-4">
            MASTER DATA PIUTANG
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4 mb-2">
                @foreach ($columns as $title => $items)
                    <div>
                        <h3 class="font-semibold mb-2 text-center bg-gray-100 py-1">{{ $title }}</h3>
                        <ul class="space-y-5">
                            @foreach ($items as $item)
                                <li class="flex items-center">
                                    <span class="mr-2">
                                        <a href="#">
                                            <div class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-md active:scale-95">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </a>
                                    </span>
                                    {{ $item }}
                                </li>
                            @endforeach
                            <li class=" ">
                                <a href="{{ route('master_data_piutang_create', ['header' => $title]) }}" class="flex flex-row justify-start items-center w-full gap-2"><div class="bg-[#0F8114] p-1 text-white hover:scale-110 active:scale-90"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4v4a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-4H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h4z"/></g></svg></div> <span>Tambahkan baru</span></a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center gap-4 mt-8">
                <button class="inline-flex items-center justify-center w-full lg:w-auto active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-6 py-2 bg-[#0F8114]">
                    Simpan
                </button>
                <button class="inline-flex items-center justify-center w-full lg:w-auto active:scale-[.95] hover:bg-white hover:text-red-700 transition-all text-white border-2 bg-red-700 border-red-700 py-2 px-6 rounded-md shadow-sm font-medium">
                    Batal
                </button>
            </div>            
        </div>
    </div>
@endsection
