@extends('layouts.app')

@section('content')

    <div class="bg-gray-100 p-6 ml-9">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif <!-- DATA PELANGGAN -->

        <h1 class="text-3xl py-2 font-semibold">PELANGGAN BARU</h1>

        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="bg-white border border-gray-400 p-4 rounded-md mb-6">
                <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">DATA PELANGGAN</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tipe Pelanggan : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <select class="border border-gray-300 p-2 rounded-md w-full" id="tipePelanggan"
                                name="tipe_pelanggan" required>
                                @foreach ($customerType as $type)
                                    <option value="{{ $type->kodeType }}"
                                        {{ old('tipe_pelanggan') == $type->kodeType ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipe_pelanggan')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p><strong>perusahaan : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <select class="border border-gray-300 p-2 rounded-md w-full" id="perusahaan" name="perusahaan"
                                required>
                                @foreach ($masterPerusahaan as $type)
                                    <option value="{{ $type->company_id }}"
                                        {{ old('perusahaan') == $type->company_id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('perusahaan')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Nama Pelanggan : </strong><span
                                class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="namaPelanggan" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="name" required>
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>

                        <p><strong>KTP :</strong> <span class="text-red-600 font-bold text-lg">*</span></p>
                        <div class="flex">


                            <!-- Input untuk KTP, akan muncul jika 'Ada' dipilih -->
                            <div id="ktp_input" class="mt-2">
                                <input type="text" id="ktp" class="border border-gray-300 p-2 rounded-md w-64 ml-4"
                                    placeholder="Masukkan KTP (Wajib Di isi)" name="ktp" maxlength="16">
                                @error('ktp')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <p class="mt-2"><strong>NPWP :</strong>
                        <div class="flex">
                            <select class="border border-gray-300 p-2 rounded-md w-32" name="npwp_option" id="npwp_option"
                                required onchange="toggleInput('npwp_option', 'npwp_input')">
                                <option value="tidak_ada">Tidak Ada</option>
                                <option value="ada">Ada</option>
                            </select>
                            <div id="npwp_input" style="display: none;" class="mt-2">
                                <input type="text" id="npwp" class="border border-gray-300 p-2 rounded-md w-64 ml-4"
                                    placeholder="Masukkan NPWP" name="npwp" maxlength="15" oninput="formatNPWP(this)">

                                @error('npwp')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        </p>
                    </div>
                    <div>
                        <p><strong>Kode Pelanggan : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="kode_pelanggan" class="border border-gray-300 p-2 rounded-md w-full"
                                name="kode_pelanggan" maxlength="15" required>
                            @error('kodePelanggan')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>% Sharing : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" class="border border-gray-300 p-2 rounded-md w-full" name="sharing"
                                required>
                            @error('sharing')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                    </div>
                </div>
            </div>

            <!-- KONTAK PELANGGAN -->
            <div class="bg-white border border-gray-400 p-4 rounded-md">
                <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">KONTAK PELANGGAN</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Alamat : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="alamat" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="alamat" required>
                            @error('alamat')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>E-mail : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="email" id="email" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="email" required>
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Whatsapp : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="whatsapp" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="whatsapp" required>
                            @error('whatsapp')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Telepon :</strong>
                            <input type="text" id="telepon" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="opsional" name="telepon">
                            @error('telepon')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Fax :</strong>
                            <input type="text" id="fax" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="opsional" name="fax">
                            @error('fax')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                    </div>

                    <div>
                        <p><strong>Kota : </strong><span class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="kota" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="kota" required>
                            @error('kota')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Kode Pos : </strong><span
                                class="text-red-600 font-bold text-lg">*</span>
                            <input type="text" id="kodePos" class="border border-gray-300 p-2 rounded-md w-full"
                                placeholder="wajib diisi" name="kode_pos" required>
                            @error('kode_pos')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <p class="mt-2"><strong>Catatan :</strong>
                            <textarea name="catatan" id="catatan" cols="30" rows="10"
                                class="border border-gray-300 p-2 rounded-md w-full"></textarea>
                            @error('catatan')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </p>
                        <div class="mt-4 text-gray-600 text-sm ">
                        </div>
                    </div>
                </div>
                <p><span class="text-red-600 font-bold text-lg">*</span> Wajib diisi. Pastikan data
                    yang diinput
                    sudah
                    benar sebelum menyimpan.</p>

            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="mt-6 mb-6">

                <button class="bg-green-700 text-white font-bold py-2 px-4 rounded-md mr-2" type="submit">Simpan</button>
                <button class="bg-white border border-gray-400 text-black font-bold py-2 px-4 rounded-md">Batal</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    {{-- <script src="{{ asset('/js/test.js') }}">
        
    </script> --}}
    @vite('resources/js/test.js')

   
        
@endpush
