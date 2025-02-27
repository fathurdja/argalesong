@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 mx-4 md:ml-9">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mx-auto mt-14 px-2 md:ml-9 lg:mt-20 ">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-2xl font-bold mb-4 text-left">MASTER DATA PAJAK</h1>
                <div class="text-sm mt-2 md:mt-0">{{ \Carbon\Carbon::now()->format('l, d/m/Y \a\t H:i:s') }}</div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded  my-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Daftar Pajak -->
            <div class="mt-4 space-y-4 ">
                @foreach ($data as $item)
                    <div class="bg-gray-100 p-4 rounded-lg shadow flex flex-row items-center justify-between gap-4">
                        <div class="md:text-left">
                            <p class="text-lg font-bold">{{ $item->name }}</p>
                            <p class="text-sm text-gray-600">Berlaku sejak: {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <input type="text" class="border bg-gray-200 text-center w-20 p-2 rounded-md" value="{{ intval($item->nilai) }}%" readonly>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('masterDataPajak.destroy', $item->id) }}" method="POST" class="inline"  data-delete="{{ $item->name }}">
                            {{-- onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->name }}?');" class=""> --}}
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 text-white rounded-md active:scale-95">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Form Tambah Pajak -->
            <form action="{{ route('masterDataPajak.store') }}" method="POST" class="mt-6">
                @csrf
                <div class="grid md:ml-40 grid-cols-1 md:grid-cols-4 gap-4">
                    <input type="text" name="new_tax_name" class="border rounded p-2 w-full" placeholder="Nama Pajak" required>
                    <input type="text" name="new_tax_value" class="border rounded p-2 w-full" placeholder="Nilai (%)" required>
                    <input type="date" name="new_tax_date" class="border rounded p-2 w-full" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                </div>

                <!-- Tombol Simpan & Batal -->
                <div class="flex justify-center gap-4 mt-4">
                    <button type="submit" class="flex-1 md:flex-none min-w-[120px] active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-2 bg-[#0F8114]">
                        Simpan
                    </button>
                    <a href="{{ route('masterDataPajak.index') }}" class="flex-1 md:flex-none min-w-[120px] text-center active:scale-[.95] hover:bg-white hover:text-red-700 transition-all text-white border-2 bg-red-700 border-red-700 py-2 px-4 rounded-md shadow-sm font-medium">
                        Batal
                    </a>
                </div>                
            </form>
        </div>
    </div>
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