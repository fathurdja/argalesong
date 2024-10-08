@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">


        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg p-6 ml-28">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">PIUTANG BARU</h1>
            </div>

            <h2 class="text-lg font-bold mb-4">Pilih Jenis Piutang :</h2>

            <form action="{{ route('piutang-types.create') }}" method="GET">
                @csrf
                <div class="mb-4">
                    <label for="jenis_form" class="block text-sm font-medium text-gray-700">Jenis Piutang</label>
                    <select id="jenis_form" name="jenis_form"
                        class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        onchange="this.form.submit()">
                        <option value="">-- Pilih Jenis Piutang --</option>
                        @foreach ($piutangTypes as $type)
                            <option value="{{ $type->id }}"
                                {{ $selectedType && $selectedType->id == $type->id ? 'selected' : '' }}>

                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if ($selectedType)
                <h2 class="text-lg font-bold mb-4">PIUTANG BARU {{ $selectedType->name }}: </h2>

                <form action="{{ route('piutang-types.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jenis_form" value="{{ $selectedType->kodePiutang }}">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                                Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="jatuh_tempo" class="block text-sm font-medium text-gray-700">Jatuh Tempo</label>
                            <input type="date" name="jatuh_tempo" id="jatuh_tempo"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <label for="jarak_hari" class="block text-sm font-medium text-gray-700 w-1/3">Jatuh Tempo</label>
                    <div class="mb-4 flex items-center gap-2">

                        <input type="text" id="jarak_hari" name="jarak_hari"
                            class="mt-1 block w-20 border-gray-300 font-bold shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <p class="mt-1 font-bold ">Hari</p>
                    </div>

                    <div class="mb-4">
                        <label for="jenis_tagihan" class="block text-sm font-medium text-gray-700">Jenis Tagihan</label>
                        <select id="jenis_tagihan" name="jenis_tagihan"
                            class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                            <option value="">-- Pilih Jenis Tagihan --</option>
                            <option value="tetap" {{ old('jenis_tagihan') == 'tetap' ? 'selected' : '' }}>Tetap
                            </option>

                            <option value="berulang" {{ old('jenis_tagihan') == 'berulang' ? 'selected' : '' }}>Berulang
                            </option>
                        </select>
                    </div>
                    @if (old('jenis_tagihan') == 'berulang')
                        <div class="mb-4">
                            <label for="jumlah_kali" class="block text-sm font-medium text-gray-700" style="none">Berapa Kali
                                Tagihan</label>
                            <input type="number" id="jumlah_kali" name="jumlah_kali" min="1"
                                class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                required>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                        <select id="nama_pelanggan" name="nama_pelanggan"
                            class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($customer as $type)
                                <option value="{{ $type->id_Pelanggan }}">
                                    {{ $type->id_Pelanggan }} {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="pajak" class="block text-sm font-medium text-gray-700">Pajak</label>
                        <select id="pajak" name="ppn_value"
                            class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            onchange="calculateTotal()">
                            <option value="">-- Pilih Pajak --</option>
                            @foreach ($pajakType as $type)
                                <option value="{{ $type->nilai }}">
                                    {{ $type->name }} ({{ $type->nilai }}%)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4 items-start">
                        <div>
                            <label for="dpp" class="block text-sm font-medium text-gray-700">DPP</label>
                            <input type="text" name="dpp" id="dpp"
                                class="mt-1 block w-full text-right p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="calculateTotal()" value="0,00">
                        </div>

                        <div>
                            <label for="ppn_value" class="block text-sm font-medium text-gray-700">PPN</label>
                            <input type="text" name="ppn_value" id="ppn_value"
                                class="mt-1 block w-full text-right border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                readonly>
                        </div>

                        <div>
                            <label for="total_piutang" class="block text-sm font-medium text-gray-700">Total Piutang</label>
                            <input type="text" name="total_piutang" id="total_piutang"
                                class="mt-1 block w-full text-right border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                readonly>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-700 text-black px-4 py-2 rounded-md hover:bg-green-600">Posting</button>
                        <button type="reset"
                            class="ml-4 bg-gray-500 text-black px-4 py-2 rounded-md hover:bg-gray-600">Batal</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('jenis_tagihan').addEventListener('change', function() {
            var jenisTagihan = this.value;
            var jumlahKaliContainer = document.getElementById('jumlah_kali');

            // Tampilkan input berapa kali tagihan hanya jika "Berulang" dipilih
            if (jenisTagihan === 'berulang') {
                jumlahKaliContainer.style.display = 'block';
            } else {
                jumlahKaliContainer.style.display = 'none';
            }
        });
    </script>
@endpush
