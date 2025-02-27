@extends('layouts.app')

@section('content')

    <div class="bg-gray-100 pt-16 sm:py-6 sm:px-2 lg:mt-10 lg:mb-10 lg:min-w-full   ">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4 text-center">PELANGGAN BARU</h1>

        {{-- <form action="{{ route('customer.store') }}" method="POST" class="overflow-auto max-h-screen"> --}}
        <form action="{{ route('customer.store') }}" method="POST" class="">
            @csrf
            <div class="bg-white border border-gray-400 p-4 rounded-md mb-6">
                <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400">DATA PELANGGAN</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tipe Pelanggan :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <select class="border border-gray-300 p-2 rounded-md w-full" id="tipePelanggan" name="tipe_pelanggan" required>
                            @foreach ($customerType as $type)
                                <option value="{{ $type->kodeType }}" {{ old('tipe_pelanggan') == $type->kodeType ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipe_pelanggan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Perusahaan :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <select class="border border-gray-300 p-2 rounded-md w-full" id="perusahaan" name="perusahaan" required>
                            @foreach ($masterPerusahaan as $type)
                                <option value="{{ $type->company_id }}" {{ old('perusahaan') == $type->company_id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('perusahaan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Nama Pelanggan :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="namaPelanggan" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="name" required>
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
 
                    </div>

                    <div>
                        <p><strong>Kode Pelanggan :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="kode_pelanggan" class="border border-gray-300 p-2 rounded-md w-full" name="kode_pelanggan" maxlength="15" required>
                        @error('kodePelanggan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>% Sharing :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full" name="sharing" required>
                        @error('sharing')
                            <span c lass="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p><strong>ktp:</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="ktp_input" class="border border-gray-300 p-2 rounded-md w-full" placeholder="Masukkan KTP (Wajib Di isi)" name="ktp" maxlength="15" required>
                        @error('ktp')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>NPWP :</strong>
                            <div class="flex">
                                <select class="border border-gray-300 p-2 rounded-md w-32" name="npwp_option" id="npwp_option"
                                    required onchange="toggleInput('npwp_option', 'npwp_input')">
                                    <option value="tidak_ada">Tidak Ada</option>
                                    <option value="ada">Ada</option>
                                </select>
                                <div id="npwp_input" style="display: none;" class="mt-2">
                                    <input type="text" id="npwp" class="border border-gray-300 p-2 rounded-md w-64 ml-4"
                                        placeholder="Masukkan NPWP" name="npwp" oninput="formatNPWP(this)">
    
                                    @error('npwp')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>  
                            </p>   
                    </div>
                </div>
            </div>

            <!-- KONTAK PELANGGAN -->
            <div class="bg-white border border-gray-400 p-4 rounded-md">
                <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">KONTAK PELANGGAN</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Alamat :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="alamat" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="alamat" required>
                        @error('alamat')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Email :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="email" id="email" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="email" required>
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Whatsapp :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="whatsapp" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="whatsapp" required>
                        @error('whatsapp')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <p><strong>Kota :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="kota" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="kota" required>
                        @error('kota')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Kode Pos :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <input type="text" id="kodePos" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi" name="kode_pos" required>
                        @error('kode_pos')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror

                        <p class="mt-2"><strong>Catatan :</strong></p>
                        <textarea name="catatan" id="catatan" cols="30" rows="10" class="border border-gray-300 p-2 rounded-md w-full"></textarea>
                        @error('catatan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <p><span class="text-red-600 font-bold text-lg">*</span> Wajib diisi. Pastikan data sudah benar sebelum menyimpan.</p>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="mt-6 mb-6 flex justify-end">
                <button class="bg-green-700 text-white font-bold py-2 px-4 rounded-md mr-2" type="submit">Simpan</button>
                <button class="bg-white border border-gray-400 text-black font-bold py-2 px-4 rounded-md">Batal</button>
            </div>
        </form>
    </div>

@endsection

@push('script')
    <script>
        function formatNPWP(input) {
            // Hapus semua karakter yang bukan angka
            let value = input.value.replace(/\D/g, '');

            // Format string NPWP: XX.XXX.XXX.X-XXX.XXX
            let formattedValue = '';

            if (value.length > 0) {
                formattedValue += value.substring(0, 2); // XX
            }
            if (value.length > 2) {
                formattedValue += '.' + value.substring(2, 5); // .XXX
            }
            if (value.length > 5) {
                formattedValue += '.' + value.substring(5, 8); // .XXX
            }
            if (value.length > 8) {
                formattedValue += '.' + value.substring(8, 9); // .X
            }
            if (value.length > 9) {
                formattedValue += '-' + value.substring(9, 12); // -XXX
            }
            if (value.length > 12) {
                formattedValue += '.' + value.substring(12, 15); // .XXX
            }

            // Tetapkan nilai input dengan format yang baru
            input.value = formattedValue;
        }

        document.getElementById('tipePelanggan').addEventListener('change', updateKodePelanggan);
        document.getElementById('tipePiutang').addEventListener('change', updateKodePelanggan);

        function updateKodePelanggan() {
            var tipePelanggan = document.getElementById('tipePelanggan').value;
            var tipePiutang = document.getElementById('tipePiutang').value;
            var kodePelangganInput = document.getElementById('kode_pelanggan');

            if (tipePelanggan && tipePiutang) {
                if (tipePelanggan === "perusahaan" && tipePiutang === "sewa-menyewa") {
                    kodePelangganInput.value = "PRSH-" + Math.floor(Math.random() * 1000000);
                } else if (tipePelanggan === "individu" && tipePiutang === "sewa-menyewa") {
                    kodePelangganInput.value = "INDV-" + Math.floor(Math.random() * 1000000);
                } else {
                    kodePelangganInput.value = "";
                }
            } else {
                kodePelangganInput.value = "";
            }
        }


        function toggleInput(dropdownId, inputDivId) {
            var dropdown = document.getElementById(dropdownId);
            var inputDiv = document.getElementById(inputDivId);

            if (dropdown.value === "ada") {
                inputDiv.style.display = "block";
            } else {
                inputDiv.style.display = "none";
            }
        }

        // On page load, check initial value of dropdowns
        document.addEventListener('DOMContentLoaded', function() {

            toggleInput('npwp_option', 'npwp_input');
        });

        // function validateForm() {
        //     let messages = [];
        //     const fields = {
        //         'Tipe Pelanggan': document.getElementById('tipePelanggan'),
        //         'Nama Pelanggan': document.getElementById('namaPelanggan'),
        //         'KTP': document.getElementById('ktp'),
        //         'NPWP': document.getElementById('npwp'),
        //         'Alamat': document.getElementById('alamat'),
        //         'E-mail': document.getElementById('email'),
        //         'Whatsapp': document.getElementById('whatsapp'),
        //         'Kota': document.getElementById('kota'),
        //         'Kode Pos': document.getElementById('kodePos')
        //     };

        //     for (const [key, field] of Object.entries(fields)) {
        //         if (field.value.trim() === '') {
        //             messages.push(key + ' wajib diisi.');
        //             field.classList.add('border-red-500');
        //         } else {
        //             field.classList.remove('border-red-500');
        //         }
        //     }

        //     if (messages.length > 0) {
        //         alert(messages.join('\n'));
        //     } else {
        //         // alert('Form sudah lengkap, data siap disimpan!');
        //         // Tambahkan logika untuk submit form di sini
        //     }
        // }
    </script>
@endpush