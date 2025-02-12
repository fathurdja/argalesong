@extends('layouts.app')

@section('content')
    <div class="container py-2 px-1 lg:px-4 lg:py-8 ">
        <!-- Form Pencarian -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
            <form method="POST" action="{{ route('kartu-pelanggan-fetchData') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tanggal Awal -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Awal</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', now()->format('Y-m-d')) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                    </div>

                    <!-- Tanggal Akhir -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date', now()->format('Y-m-d')) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                    </div>

                    <!-- Pilih Perusahaan -->
                    <div>
                        <label for="idcompany" class="block text-sm font-medium text-gray-700 mb-2">Pilih Perusahaan</label>
                        <input list="groupList" name="idcompany" id="idcompany"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                            placeholder="Pilih Perusahaan..." onchange="fetchCustomers()" />
                        <datalist id="groupList">
                            <option value="">-- Semua Perusahaan --</option>
                            @foreach ($perusahaan as $group)
                                <option value="{{ $group->company_id }}">{{ $group->name }}</option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <!-- Pilih Pelanggan -->
                <div class="mt-6">
                    <label for="id_Pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Pilih Pelanggan</label>
                    <input list="pelangganList" name="nama_pelanggan" id="id_Pelanggan"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-2"
                        placeholder="Pilih Pelanggan..." />
                    <datalist id="pelangganList">
                        <!-- Opsi pelanggan akan diperbarui dengan AJAX -->
                    </datalist>
                    <input type="hidden" name="id_Pelanggan_actual" id="id_Pelanggan_actual" />
                </div>

                <!-- Tombol Cari -->
                <div class="mt-6 text-right">
                    <button type="submit"
                        class="active:scale-[.95] hover:bg-white hover:text-[#3D5AD0] transition-all font-medium text-white border-2 border-[#3D5AD0] rounded-md shadow-sm px-4 py-1 bg-[#3D5AD0]">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Piutang, Pembayaran, dan Denda -->
        <div class="bg-white p-4">
            <div class=" justify-between items-center mb-2">
                <div class=" justify-between items-center mb-2">
                    <div class="text-lg font-bold">
                        {{ $selectedCustomer->name ?? 'Customer Not Selected' }}
                        <!-- Display the selected customer's name -->
                    </div>
                    <div class="text-sm">
                        Periode: {{ $startDate }} s/d {{ $endDate }} <!-- Display the selected date range -->
                    </div>
                </div>
                <div class="flex overflow-x-auto">
                    <!-- Piutang Section -->
                    <div class="w-2/3 border  min-w-max">
                        <div class="bg-green-500 text-white text-center font-bold">PIUTANG</div>
                        <div class="flex">
                            <div class="w-1/2 border-r min-w-max">
                                <div class="bg-green-500 text-white text-center font-bold">Penagihan Piutang</div>
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="bg-gray-300">
                                            <th class="border border-black p-1">Tgl Terbit</th>
                                            <th class="border border-black p-1">No Invoice</th>
                                            <th class="border border-black p-1">No Bukti Jurnal</th>
                                            <th class="border border-black p-1">Keterangan</th>
                                            <th class="border border-black p-1">Nominal</th>
                                            <th class="border border-black p-1">Tgl Jatuh Tempo</th>
                                            <th class="border border-black p-1">Umur Piutang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Baris P0 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P0')
                                                <tr class="bg-yellow-100">
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1">{{ $item->noinvoice }}</td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">{{ $item->tgljtempo }}</td>
                                                    <td class="border border-black p-1">0</td>
                                                </tr>
                                                <!-- Tambahkan baris kosong di bagian pembayaran -->
                                            @endif
                                        @endforeach

                                        <!-- Baris P1 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P1')
                                                <tr>
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1">{{ $item->noinvoice }}</td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">{{ $item->tgljtempo }}</td>
                                                    <td class="border border-black p-1">{{ $item->umurPiutang }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-1/2 min-w-max">
                                <div class="bg-green-500 text-white text-center font-bold">Pembayaran Piutang</div>
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="bg-gray-300">
                                            <th class="border border-black p-1">Tgl Bayar</th>
                                            <th class="border border-black p-1">No Bukti Jurnal</th>
                                            <th class="border border-black p-1">Keterangan</th>
                                            <th class="border border-black p-1">Nominal</th>
                                            <th class="border border-black p-1">Diskon</th>
                                            <th class="border border-black p-1">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P0')
                                                <tr class="bg-yellow-100">
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1"></td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        0
                                                    </td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}</td>

                                                </tr>
                                                <!-- Tambahkan baris kosong di bagian pembayaran -->
                                            @endif
                                        @endforeach
                                        <!-- Baris P2 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P2')
                                                <tr>
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1"></td>
                                                    <td class="border border-black p-1">{{ $item->ketbayar }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nbayar, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">0</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->saldo, 2) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                @php
                                    // Ubah array menjadi koleksi dan ambil saldo terakhir dari P2
                                    $saldoTerakhir = collect($data)
                                        ->filter(fn($item) => $item->idrows === 'P2') // Filter baris dengan idrows 'P2'
                                        ->last(); // Ambil item terakhir

                                    $saldo = collect($data)
                                        ->filter(fn($item) => $item->idrows === 'P1') // Filter baris dengan idrows 'P1'
                                        ->last();

                                    // Pastikan untuk memeriksa keberadaan objek sebelum mengakses propertinya
                                    $saldoTerakhir = $saldoTerakhir
                                        ? $saldoTerakhir->saldo
                                        : ($saldo
                                            ? $saldo->saldo
                                            : 0);
                                @endphp


                                <!-- Bagian saldo -->

                                <div class="flex mt-11">
                                    <p class="text-right p-2 font-bold">Saldo Terakhir: </p>
                                    <div class="text-right p-2 font-bold">{{ number_format($saldoTerakhir, 2) }}</div>
                                </div>

                            </div>

                        </div>
                        
                        
                    </div>
                </div>
            </div>
        @endsection
        @push('script')
            <script>
                function fetchCustomers() {
                    const companyId = document.getElementById('idcompany').value; // Ambil ID perusahaan yang dipilih
                    const pelangganList = document.getElementById('pelangganList'); // Ambil elemen data list pelanggan

                    // Kosongkan data list pelanggan
                    pelangganList.innerHTML = '';

                    // Pastikan companyId tidak kosong
                    if (companyId) {
                        fetch(`/get-customers/${companyId}`) // Panggil endpoint untuk mengambil pelanggan
                            .then(response => response.json())
                            .then(data => {
                                // Tambahkan opsi pelanggan ke dalam data list
                                data.forEach(customer => {
                                    const option = document.createElement('option');
                                    option.value = customer.id_Pelanggan; // Tampilkan nama pelanggan di input
                                    option.setAttribute('data-id', customer.id_Pelanggan); // Simpan ID pelanggan
                                    pelangganList.appendChild(option);
                                });

                                // Simpan ID pelanggan terpilih di hidden input jika diperlukan
                                document.getElementById('id_Pelanggan_actual').value = '';
                            })
                            .catch(error => console.error('Error fetching customers:', error));
                    }
                }
                document.getElementById('id_Pelanggan').addEventListener('input', function() {
                    const pelangganList = document.getElementById('pelangganList');
                    const options = pelangganList.options;
                    const inputValue = this.value; // Nilai input pengguna

                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === inputValue) {
                            // Jika input sesuai dengan nama pelanggan, set hidden input dengan ID pelanggan
                            document.getElementById('id_Pelanggan_actual').value = options[i].getAttribute('data-id');
                            break;
                        }
                    }
                });
            </script>
        @endpush
