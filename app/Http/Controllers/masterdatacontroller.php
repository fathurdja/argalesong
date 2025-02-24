<?php

namespace App\Http\Controllers;

use App\Models\JatuhTempo;
use App\Models\LewatPlafon;
use App\Models\tipePelanggan;
use App\Models\TipePiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class masterdatacontroller extends Controller
{
    function index()
    {
        $tipePelanggan = tipePelanggan::all(); // Menggunakan all() untuk mendapatkan objek
        $tipePiutang = TipePiutang::all(); // Menggunakan all() untuk mendapatkan objek
        $jatuhTempo = JatuhTempo::all(); // Menggunakan all() untuk mendapatkan objek
        $lewatPlafon = LewatPlafon::all(); // Menggunakan all() untuk mendapatkan objek
    
        $columns = [
            'Tipe Pelanggan' => $tipePelanggan,
            'Tipe Piutang' => $tipePiutang,
            'Jika Jatuh Tempo' => $jatuhTempo,
            'Jika Lewat Plafon' => $lewatPlafon
        ];
    
        return view('masterData.MD_piutang', ['columns' => $columns]);
    }
    

    public function storeTipePelanggan(Request $request)
    {
        $request->validate([
            'headerName' => 'required|string|max:255',
            'typeName' => 'required|string|max:255',
        ]);

        $table = $this->getTableName($request->input('headerName'));
        $nextId = $this->generateNextId($table);

        DB::table($table)->insert([
            'kodeType' => $nextId,
            'name' => $request->input('typeName'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('master_data_piutang')->with('success', 'Item berhasil ditambahkan.');
    }

    private function generateNextId($table)
    {
        $lastRecord = DB::table($table)
            ->where('kodeType', 'like', 'P%')
            ->orderBy(DB::raw('CAST(SUBSTRING(kodeType, 2) AS UNSIGNED)'), 'desc')
            ->first();

        if (!$lastRecord) {
            return 'P1';
        }

        if (preg_match('/P(\d+)/', $lastRecord->kodeType, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
            return 'P' . $nextNumber;
        }

        return 'P1';
    }

    private function getTableName($type)
    {
        switch ($type) {
            case 'Tipe Pelanggan':
                return 'tipepelanggan';
            case 'Tipe Piutang':
                return 'tipepiutang';
            case 'Jika Jatuh Tempo':
                return 'jatuh_tempos';
            case 'Jika Lewat Plafon':
                return 'lewat_plafons';
            default:
                throw new \Exception('Unknown type: ' . $type);
        }
    }

    public function create(Request $request)
    {
        $tipePelanggan = tipePelanggan::all(); // Menggunakan all() untuk mendapatkan objek
        $tipePiutang = TipePiutang::all(); // Menggunakan all() untuk mendapatkan objek
        $jatuhTempo = JatuhTempo::all(); // Menggunakan all() untuk mendapatkan objek
        $lewatPlafon = LewatPlafon::all(); // Menggunakan all() untuk mendapatkan objek

        $columns = [
            'Tipe Pelanggan' => $tipePelanggan,
            'Tipe Piutang' => $tipePiutang,
            'Jika Jatuh Tempo' => $jatuhTempo,
            'Jika Lewat Plafon' => $lewatPlafon
        ];

        $header = $request->query('header');

        return view('masterData.MD_piutang', compact('columns', 'header'));
    }

    public function storeTipePiutang(Request $request)
    {
        $request->validate([
            'headerName' => 'required|string|max:255',
            'kode' => 'required|string|max:10',
            'typeName' => 'required|string|max:255',
        ]);

        $table = $this->getTableName($request->input('headerName'));

        DB::table($table)->insert([
            'kodePiutang' => $request->input('kode'),
            'name' => $request->input('typeName'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('master_data_piutang')->with('success', 'Item berhasil ditambahkan.');
    }

    // Method destroy
        public function destroy(Request $request)
    {
        // Validasi bahwa ada header dan id yang diberikan
        $request->validate([
            'headerName' => 'required|string|max:255',
            'id' => 'required|integer',
        ]);
       

        // Mendapatkan nama tabel berdasarkan header yang diterima
        $table = $this->getTableName($request->input('headerName'));

        // Menghapus record dari tabel yang sesuai
        $deleted = DB::table($table)->where('id', $request->input('id'))->delete();

        if ($deleted) {
            return redirect()->route('master_data_piutang')->with('success', 'Item berhasil dihapus.');
        } else {
            return redirect()->route('master_data_piutang')->with('error', 'Item tidak ditemukan.');
        }
    }

}
