@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 border-black rounded-lg">
        <div class="bg-blue-700 py-7 px-10">
            <h2 class="text-xl font-bold">Account Receive - Tambah Tagihan</h2>
        </div>

        <form id="tagihanForm" class="bg-white px-6">
            <div class="mt-4">
                <label for="rekanan" class="block text-gray-700">Rekanan:<span class="text-red-500"> wajib</span></label>
                <select id="rekanan" name="rekanan" class="mt-1 block w-full border-gray-300 rounded-md">
                    <option value="">Pilih Rekanan</option>
                    @foreach ($rekanans as $rekanan)
                        <option value="{{ $rekanan->id }}">{{ $rekanan->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="listPiutangSection" class="mt-4 bg-slate-500 hidden">
                <div class="mt-4 border-t-2 border-gray-200 pt-4">
                    <h3 class="text-lg font-semibold text-red-700">List Piutang</h3>
                </div>
                <div class="mt-4 flex items-center">
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 mt-5 rounded">+</button>
                    <div class="">
                        <label for="nomor_bukti" class="block text-gray-700 ml-5 ">NO BUKTI</label>
                        <input type="text" id="nomor_bukti" name="nomor_bukti" placeholder="NO BUKTI"
                            class="block border-gray-300 rounded-md ml-4">
                    </div>

                    <div>
                        <label for="vendor" class="block text-gray-700">Vendor:</label>
                        <input type="text" id="vendor" name="vendor" readonly
                            class="block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="tanggal_trans" class="block text-gray-700">Tanggal Trans:</label>
                        <input type="date" id="tanggal_trans" name="tanggal_trans" readonly
                            class="block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="tanggal_exp" class="block text-gray-700">Tanggal Exp:</label>
                        <input type="date" id="tanggal_exp" name="tanggal_exp" readonly
                            class="block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="harga" class="block text-gray-700">Harga:</label>
                        <input type="text" id="harga" name="harga" readonly
                            class="block w-full border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="ppn" class="block text-gray-700">Pajak Pertambahan Nilai (PPN):</label>
                    <input type="text" id="ppn" name="ppn" placeholder="masukkan nominal PPN"
                        class="mt-1 block  border-gray-300 rounded-md">
                </div>
                <div class="mt-4">
                    <label for="total_harga" class="block text-gray-700">Total Tagihan:</label>
                    <input type="text" id="total_harga" name="total_harga" readonly
                        class="mt-1 block  border-gray-300 rounded-md">
                </div>
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-700">Keterangan:</label>
                    <input type="text" id="keterangan" name="keterangan" placeholder="keterangan"
                        class="mt-1 block  border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            </div>
            @csrf
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#rekanan').on('change', function() {
                if ($(this).val()) {
                    $('#listPiutangSection').removeClass('hidden');
                } else {
                    $('#listPiutangSection').addClass('hidden');
                }
            });

            $('#nomor_bukti').on('blur', function() {
                var nomorBukti = $(this).val();
                if (nomorBukti) {
                    $.ajax({
                        url: '{{ url('/tagihan/get-data') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            nomor_bukti: nomorBukti
                        },
                        success: function(response) {
                            if (response) {
                                $('#vendor').val(response.vendor);
                                $('#tanggal_trans').val(response.tanggal_trans);
                                $('#tanggal_exp').val(response.tanggal_exp);
                                $('#harga').val(response.harga);
                            }
                        }
                    });
                }
            });

            $('#harga, #ppn').on('blur', function() {
                var harga = parseFloat($('#harga').val()) || 0;
                var ppn = parseFloat($('#ppn').val()) || 0;
                var total = harga + ppn;
                $('#total_harga').val(total.toFixed(2));
            });
        });
    </script>
@endsection
