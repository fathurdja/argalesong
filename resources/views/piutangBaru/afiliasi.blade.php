@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">


        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 ml-9">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-white shadow-md rounded-lg p-8 ml-9 min-w-full">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">PIUTANG BARU</h1>
            </div>

            <h2 class="text-lg font-bold mb-4">Pilih Jenis Piutang :</h2>

            <form action="{{ route('piutang-types.create') }}" method="GET" class="ml-8">
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

                <form action="{{ route('piutang-types.store') }}" method="POST" class="ml-8">
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
                        <div class="mt-2 flex items-center gap-4">
                            <div class="flex items-center">
                                <label for="" class="mr-2">PPN:</label>
                                <select name="ppnType" id="ppn_type"
                                    class="mt-1 block w-52 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                                    <option value="Tidak Ada">Tidak Ada</option>
                                    @foreach ($ppnTypes as $pajakType)
                                        <option value="{{ $pajakType->nilai }}">
                                            {{ $pajakType->nilai }}%</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center ml-4 ">
                                <label for="pajak_type" class="mr-2">PPh:</label>
                                <select name="pajak_type" id="pajak_type" onchange="fetchPajakRates(this.value)"
                                    class="mt-1 block w-52 bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                                    <option value="Tidak Ada">Tidak Ada</option>
                                    @foreach ($pajakTypes as $pajakType)
                                        <option value="{{ $pajakType }}">{{ $pajakType }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center ml-4">
                                <label for="tarif" class="mr-2">tarif:</label>
                                <select name="tarif" id="tarif"
                                    class="bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2">
                                    <option value="">-- Pilih Tarif --</option>
                                </select>
                            </div>
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
                            <label for="pph_value" class="block text-sm font-medium text-gray-700">PPh</label>
                            <input type="text" name="pph_value" id="pph_value"
                                class="mt-1 block w-full text-right border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                readonly>
                        </div>



                    </div>
                    <div>
                        <label for="total_piutang" class="block text-sm font-medium text-gray-700">Total
                            Piutang</label>
                        <input type="text" name="total_piutang" id="total_piutang"
                            class="mt-1 block w-full text-right border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            readonly>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Posting</button>
                        <button type="reset"
                            class="ml-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

@endsection

@push('script')
    <script>
        function formatRupiah(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatDPP() {
            const dppInput = document.getElementById('dpp');
            let dppValue = dppInput.value.replace(/\./g, ''); // Remove existing dots for reformatting
            if (!isNaN(dppValue) && dppValue !== "") {
                dppInput.value = formatRupiah(dppValue); // Apply Rupiah format
            } else {
                dppInput.value = ""; // Clear if not a valid number
            }
            calculatePiutang(); // Recalculate totals
        }

        function calculatePiutang() {
            const dppInput = document.getElementById('dpp');
            const ppnInput = document.getElementById('ppn_value');
            const pphInput = document.getElementById('pph_value');
            const totalPiutangInput = document.getElementById('total_piutang');
            const ppnCheckbox = document.getElementById('ppn_checkbox');
            const pphRateSelect = document.getElementById('tarif');

            const ppnRate = 11; // Set PPN rate in percent

            // Parse DPP without thousand separators
            const dpp = parseFloat(dppInput.value.replace(/\./g, '')) || 0;

            // Calculate PPN if checked
            let ppn = 0;
            if (ppnCheckbox.checked) {
                ppn = (ppnRate / 100) * dpp;
                ppnInput.value = formatRupiah(ppn.toFixed(2)); // Display formatted PPN
            } else {
                ppnInput.value = ""; // Clear PPN if unchecked
            }

            // Get PPh rate and calculate if selected
            const pphRate = parseFloat(pphRateSelect.value) || 0;
            const pph = (pphRate / 100) * dpp;
            pphInput.value = formatRupiah(pph.toFixed(2)); // Display formatted PPh

            // Calculate and display total
            const totalPiutang = dpp + ppn - pph;
            totalPiutangInput.value = formatRupiah(totalPiutang.toFixed(2)); // Display formatted total
        }
    </script>
@endpush
