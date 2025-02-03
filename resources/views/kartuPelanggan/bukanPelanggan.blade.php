@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 ml-9">
        <!-- Search Bar -->
        <div class="mb-6">
            <input type="text" placeholder="cari kode / nama"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
        </div>

        <!-- Ledger Table Section -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <!-- Account 1 -->
            <h3 class="text-lg font-bold mb-4">0108.01001 PPN Masukan</h3>
            <div class="mb-2 text-sm">Periode: 01/07/2024 s/d 12/08/2024</div>
            <table class="table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl
                            Terbit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Bukti
                            Jurnal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Keterangan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debet
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Kredit
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">29/5/2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FN0240529001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">xxxx</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">254,545</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">254,545</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/6/2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FN0240628001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">xxxxxx</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">67,919</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">322,464</td>
                    </tr>
                    <tr class="bg-gray-50 font-bold">
                        <td colspan="5" class="px-6 py-4 text-right">Total</td>
                        <td class="px-6 py-4 text-right">577,009</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Account 2 -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-lg font-bold mb-4">0105.01004 Asuransi Dibayar Di Muka</h3>
            <div class="mb-2 text-sm">Periode: 01/07/2024 s/d 12/08/2024</div>
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl
                            Terbit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Bukti
                            Jurnal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Keterangan</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debet
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Kredit
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">29/5/2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FN0240529001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">xxxx</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">5,400,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">5,400,000</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28/6/2024</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">FN0240628001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">xxxxxx</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">67,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">5,467,000</td>
                    </tr>
                    <tr class="bg-gray-50 font-bold">
                        <td colspan="5" class="px-6 py-4 text-right">Total</td>
                        <td class="px-6 py-4 text-right">10,867,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
{{-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Fast Food Indonesia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-200 p-4">
    
</body>
</html> --}}