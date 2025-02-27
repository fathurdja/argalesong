@extends('layouts.app')

@section('content')
    <div class="max-w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden p-10 lg:p-7 mb-5 mt-10 lg:mt-20">
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
                            @if ($item)
                                <li class="flex items-center">
                                    <span class="mr-2">
                                        <form action="{{ route('master_data_destroy') }}" method="POST"  data-delete="{{ $item->name }}">
                                        {{-- <form action="{{ route('master_data_destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $item->name }}?');"> --}}
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="headerName" value="{{ $title }}">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-md active:scale-95">
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </span>
                                    {{ $item->name }} <!-- Mengakses name dari objek -->
                                </li>
                            @else
                                <li class="text-red-500">Item tidak ditemukan</li>
                            @endif
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

    <!-- Modal -->
    @if (request()->has('header'))
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <!-- Modal content -->
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambahkan Item Baru</h3>
                                <div class="mt-2">
                                    <form id="addItemForm" method="POST"
                                        action="{{ request('header') === 'Tipe Piutang' ? route('storeTipePiutang') : route('storeTipePelanggan') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="headerName" class="block text-sm font-medium text-gray-700">Nama Item</label>
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
                                            <label for="itemType" class="block text-sm font-medium text-gray-700">Nama Tipe</label>
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
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("form[data-delete]").forEach((form) => {
        form.addEventListener("submit", (event) => {
            const name = form.getAttribute("data-delete");
            deleteConfirm(event, name);
        });
    });
});


function deleteConfirm(event, name) {
    event.preventDefault();
    
    Swal.fire({
        title: `Apakah Anda yakin ingin menghapus data ${name}?`,
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.submit();
        }
    });

    return false; 
}


</script>
    
@endpush