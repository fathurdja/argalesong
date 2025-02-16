@extends('layouts.app')

@section('content')


<div class="sm:p-6 bg-white rounded-lg shadow-md mt-6 w-full">
    <div class="flex justify-start mb-4 w-full flex-col sm:flex-row gap-2 sm:gap-10 px-2 py-1 sm:p-4">
        <div class="flex items-center">
            <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
            <select id="tahun" name="tahun" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                <option value="2023">2023</option>
                <option value="2024" selected>2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
        <div class="flex items-center">
            <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
            <select id="bulan" name="bulan" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 sm:text-sm rounded-md">
                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                    <option value="{{ $index + 1 }}">{{ $bulan }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="min-w-full overflow-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Invoice</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">Kode Perusahaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">Tgl Invoice</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">Tgl Jatuh Tempo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piutang Belum Dibayar</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- @foreach ($customers as $customer)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->idpelanggan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->no_invoice }}</td>
                    <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">{{ $customer->kodepiutang }}</td>
                    <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">{{ $customer->idpelanggan }}</td>
                    <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">{{ $customer->tgltra }}</td>
                    <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">{{ $customer->tgl_jatuh_tempo }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->jumlahTagihan }}</td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    <script>
document.addEventListener("DOMContentLoaded", () => {
    const tahunSelect = document.getElementById("tahun");
    const bulanSelect = document.getElementById("bulan");
    const tbody = document.querySelector("tbody");

    const getData = async () => {
        try {
            const response = await fetch(`/jatuh-tempo/data/${tahunSelect.value}/${bulanSelect.value}`);
            if (!response.ok) throw new Error("Gagal mengambil data");
            
            const data = await response.json();
            console.log(data); 

            tbody.innerHTML = "";
            let rows = "";
            data.forEach(pelanggan => {
                rows += `<tr>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.idpelanggan}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.no_invoice}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.kodepiutang}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.idpelanggan}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgltra}</td>
                            <td class="px-6 py-4 text-sm hidden sm:table-cell text-gray-500">${pelanggan.tgl_jatuh_tempo}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">${pelanggan.jumlahTagihan ?? '-'}</td>
                        </tr>`;
            });

            tbody.innerHTML = rows;
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            tbody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">Gagal mengambil data</td></tr>`;
        }
    };

    tahunSelect.addEventListener("change", getData);
    bulanSelect.addEventListener("change", getData);

    getData(); 
});
</script>
@endpush
