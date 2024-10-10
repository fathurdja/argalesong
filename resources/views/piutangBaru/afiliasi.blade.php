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
                    <div class="flex">
                        <div class="mb-4">
                            <label for="jenis_tagihan" class="block text-sm font-medium text-gray-700">Jenis Tagihan</label>
                            <select id="jenis_tagihan" name="jenis_tagihan"
                                class="mt-1 block w-52 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                                <option value="">-- Pilih Jenis Tagihan --</option>
                                <option value="tetap" {{ old('jenis_tagihan') == 'tetap' ? 'selected' : '' }}>Tetap
                                </option>
                                <option value="berulang" {{ old('jenis_tagihan') == 'berulang' ? 'selected' : '' }}>
                                    Berulang
                                </option>
                            </select>
                        </div>
                        <div id="jumlah_kali_container" class="mb-4" style="display: none;">
                            <label for="jumlah_kali" class="block ml-4 text-sm font-medium text-gray-700">Berapa Kali
                                Tagihan</label>
                            <input type="number" id="jumlah_kali" name="jumlah_kali" min="1"
                                class="mt-1 block w-32 ml-4 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                                value="{{ old('jumlah_kali') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pajak</label>
                        <div class="mt-2 space-y-2">
                            @foreach ($pajakType as $type)
                                <div class="flex items-center">
                                    <input type="checkbox" id="pajak_{{ $type->id }}" name="pajak[]"
                                        value="{{ $type->nilai }}" data-nama="{{ $type->name }}"
                                        data-nilai="{{ $type->nilai }}"
                                        data-jenis="{{ $type->kode_pajak === 'PJK1' ? 'tambah' : 'kurang' }}"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        onchange="updateTaxCalculation()">
                                    <label for="pajak_{{ $type->id }}" class="ml-2 block text-sm text-gray-900">
                                        {{ $type->name }} ({{ $type->nilai }}%)
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>



                    <div class="grid grid-cols-2 gap-4 mb-4 items-start">
                        <div>
                            <label for="dpp" class="block text-sm font-medium text-gray-700">DPP</label>
                            <input type="text" name="dpp" id="dpp"
                                class="mt-1 block w-full text-right p-3 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                oninput="formatDPP(this)" value="0">
                        </div>

                        <div>
                            <label for="ppn_value" class="block text-sm font-medium text-gray-700">PPN</label>
                            <input type="text" name="ppn_value" id="ppn_value"
                                class="mt-1 block w-full text-right border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                readonly>
                        </div>

                        <div>
                            <label for="total_piutang" class="block text-sm font-medium text-gray-700">Total
                                Piutang</label>
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
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalTransaksiInput = document.getElementById('tanggal_transaksi');
            const jatuhTempoInput = document.getElementById('jatuh_tempo');
            const jarakHariInput = document.getElementById('jarak_hari');

            function updateJarakHari() {
                const tanggalTransaksi = new Date(tanggalTransaksiInput.value);
                const jatuhTempo = new Date(jatuhTempoInput.value);

                if (tanggalTransaksi && jatuhTempo) {
                    const diffTime = Math.abs(jatuhTempo - tanggalTransaksi);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    jarakHariInput.value = diffDays;
                }
            }

            function updateJatuhTempo() {
                const tanggalTransaksi = new Date(tanggalTransaksiInput.value);
                const jarakHari = parseInt(jarakHariInput.value, 10);

                if (tanggalTransaksi && !isNaN(jarakHari)) {
                    const jatuhTempo = new Date(tanggalTransaksi);
                    jatuhTempo.setDate(jatuhTempo.getDate() + jarakHari);
                    jatuhTempoInput.value = jatuhTempo.toISOString().split('T')[0];
                }
            }

            tanggalTransaksiInput.addEventListener('change', updateJarakHari);
            jatuhTempoInput.addEventListener('change', updateJarakHari);
            jarakHariInput.addEventListener('input', updateJatuhTempo);

        });
    </script>
@endpush
