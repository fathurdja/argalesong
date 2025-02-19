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
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
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