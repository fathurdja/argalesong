<!-- resources/views/masterData/masterData_pajak.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold">MASTER DATA PAJAK</h1>
                <div class="text-sm">{{ \Carbon\Carbon::now()->format('l, d/m/Y \a\t H:i:s') }}</div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-4">
                <form action="{{ route('masterDataPajak.store') }}" method="POST">
                    @csrf
                    <div id="taxEntries">
                        @foreach ($data as $item)
                            <div class="grid grid-cols-6 gap-2  mb-4">
                                <p class="text-xl font-bold text-center">{{ $item->name }}</p>
                                <input type="text" name="tax_value[]" class="border bg-slate-400 text-center w-28 p-2"
                                    value="{{ intval($item->nilai) }}%" readonly>
                                <p class="text-lg font-bold text-center">Berlaku Sejak</p>
                                <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add new tax entry -->
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <input type="text" name="new_tax_name" class="border rounded p-2" placeholder="tambahkan baru"
                            required>
                        <input type="text" name="new_tax_value" class="border rounded p-2" placeholder="nilai (%)"
                            required>
                        <input type="date" name="new_tax_date" class="border rounded p-2" required>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 mx-3 rounded shadow">Simpan</button>
                        <a href="{{ route('masterDataPajak.index') }}"
                            class="bg-red-500 text-white px-4 py-2 mx-3 rounded shadow">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
