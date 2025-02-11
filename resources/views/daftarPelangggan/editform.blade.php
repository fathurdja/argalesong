@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <!-- Form Edit Pelanggan -->
        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white border border-gray-400 p-4 rounded-md mb-6">
                <h2 class="text-2xl font-bold mb-4">EDIT DATA PELANGGAN</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tipe Pelanggan :</strong>
                            <select class="border border-gray-300 p-2 rounded-md w-full" id="tipePelanggan"
                                name="tipe_pelanggan" required>
                                @foreach ($tipePelangganOptions as $option)
                                    <option value="{{ $option->kodeType }}"
                                        {{ $option->kodeType == $customer->idtypepelanggan ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </p>
                        <p><strong>perusahaan :</strong>
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

                        <p class="mt-2"><strong>Nama Pelanggan :</strong>
                            <input type="text" id="namaPelanggan" class="border border-gray-300 p-2 rounded-md w-full"
                                name="name" value="{{ $customer->name }}" required>
                        </p>
                        <p class="mt-2"><strong>KTP :</strong>
                            <input type="text" id="ktp" class="border border-gray-300 p-2 rounded-md w-full"
                                name="ktp" value="{{ $customer->ktp }}" maxlength="16" required>
                        </p>
                        <p class="mt-2"><strong>NPWP :</strong>
                            <input type="text" id="npwp" class="border border-gray-300 p-2 rounded-md w-full"
                                name="npwp" value="{{ old('npwp', $customer->npwp ?? '') }}" maxlength="15">
                        </p>
                    </div>

                    <div>
                        <p><strong>Kode Pelanggan :</strong>
                            <input type="text" id="kodePelanggan" class="border border-gray-300 p-2 rounded-md w-full"
                                name="kode_pelanggan" value="{{ $customer->id_Pelanggan }}" required maxlength="15">
                        </p>
                        <p class="mt-2"><strong>% Sharing :</strong>
                            <input type="text" class="border border-gray-300 p-2 rounded-md w-full" name="sharing"
                                value="{{ $customer->sharing }}">
                        </p>
                    </div>
                </div>
            </div>

            <!-- KONTAK PELANGGAN -->
            <div class="bg-white border border-gray-400 p-4 rounded-md">
                <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">KONTAK PELANGGAN</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Alamat :</strong>
                            <input type="text" id="alamat" class="border border-gray-300 p-2 rounded-md w-full"
                                name="alamat" value="{{ $customer->alamat }}" required>
                        </p>
                        <p class="mt-2"><strong>E-mail :</strong>
                            <input type="email" id="email" class="border border-gray-300 p-2 rounded-md w-full"
                                name="email" value="{{ $customer->email }}" required>
                        </p>
                        <p class="mt-2"><strong>Whatsapp :</strong>
                            <input type="text" id="whatsapp" class="border border-gray-300 p-2 rounded-md w-full"
                                name="whatsapp" value="{{ $customer->whatsapp }}">
                        </p>
                        <p class="mt-2"><strong>Telepon :</strong>
                            <input type="text" id="telepon" class="border border-gray-300 p-2 rounded-md w-full"
                                name="telepon" value="{{ $customer->telepon }}">
                        </p>
                        <p class="mt-2"><strong>Fax :</strong>
                            <input type="text" id="fax" class="border border-gray-300 p-2 rounded-md w-full"
                                name="fax" value="{{ $customer->fax }}">
                        </p>
                    </div>

                    <div>
                        <p><strong>Kota :</strong>
                            <input type="text" id="kota" class="border border-gray-300 p-2 rounded-md w-full"
                                name="kota" value="{{ $customer->kota }}" required>
                        </p>
                        <p class="mt-2"><strong>Kode Pos :</strong>
                            <input type="text" id="kodePos" class="border border-gray-300 p-2 rounded-md w-full"
                                name="kode_pos" value="{{ $customer->kode_pos }}" required>
                        </p>
                        <p class="mt-2"><strong>Catatan :</strong>
                            <input type="text" id="catatan" class="border border-gray-300 p-2 rounded-md w-full"
                                name="catatan" value="{{ $customer->catatan }}">
                        </p>
                    </div>
                </div>
            </div>
            <!-- Tombol Simpan dan Batal -->
            <div class="mt-6">
                <button class="bg-green-500 text-white font-bold py-2 px-4 rounded-md mr-2" type="submit">Simpan</button>
                <a href="{{ route('customer.index') }}"
                    class="bg-white border border-gray-400 text-black font-bold py-2 px-4 rounded-md">Batal</a>
            </div>
        </form>
    </div>
@endsection
