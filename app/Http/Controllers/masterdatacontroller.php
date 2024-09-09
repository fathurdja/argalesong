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

        $tipePelanggan = tipePelanggan::pluck('name')->toArray();
        $tipePiutang = TipePiutang::pluck('name')->toArray();
        $jatuhTempo = JatuhTempo::pluck('name')->toArray();
        $lewatPlafon = LewatPlafon::pluck('name')->toArray();

        $columns = [
            'Tipe Pelanggan' => $tipePelanggan,
            'Tipe Piutang' => $tipePiutang,
            'Jika Jatuh Tempo' => $jatuhTempo,
            'Jika Lewat Plafon' => $lewatPlafon
        ];

        // Debugging the content of $columns


        return view('masterData.MD_piutang', ['columns' => $columns]);
        // Return the view with the data

    }

    public function storeTipePelanggan(Request $request)
    {
        // Validate the request data
        $request->validate([
            'headerName' => 'required|string|max:255',
            'typeName' => 'required|string|max:255',
        ]);

        // Determine the table to insert data into based on the type
        $table = $this->getTableName($request->input('headerName'));
        $nextId = $this->generateNextId($table);
        // Insert the data into the appropriate table
        DB::table($table)->insert([
            'kodeType' => $nextId,
            'name' => $request->input('typeName'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('master_data_piutang')->with('success', 'Item berhasil ditambahkan.');
    }
    private function generateNextId($table)
    {
        // Extract the highest numeric part from the IDs in the table that match the pattern 'P<number>'
        $lastRecord = DB::table($table)
            ->where('kodeType', 'like', 'P%')
            ->orderBy(DB::raw('CAST(SUBSTRING(kodeType, 2) AS UNSIGNED)'), 'desc')
            ->first();

        if (!$lastRecord) {
            return 'P1'; // Default to 'P1' if there are no records that match the pattern
        }

        // Extract the numeric part from the last record
        if (preg_match('/P(\d+)/', $lastRecord->kodeType, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
            $nextId = 'P' . $nextNumber;
            return $nextId;
        }

        return 'P1'; // Fallback to 'P1' in case of unexpected issues
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
                // Add other cases here for different types
            default:
                throw new \Exception('Unknown type: ' . $type);
        }
    }

    public function create(Request $request)
    {

        $tipePelanggan = tipePelanggan::pluck('name')->toArray();
        $tipePiutang = TipePiutang::pluck('name')->toArray();
        $jatuhTempo = JatuhTempo::pluck('name')->toArray();
        $lewatPlafon = LewatPlafon::pluck('name')->toArray();

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
        // Validate the request data
        $request->validate([
            'headerName' => 'required|string|max:255',
            'kode' => 'required|string|max:10',
            'typeName' => 'required|string|max:255',
        ]);

        // Determine the table to insert data into based on the type
        $table = $this->getTableName($request->input('headerName'));

        // Insert the data into the appropriate table
        DB::table($table)->insert([
            'kodePiutang' => $request->input('kode'),
            'name' => $request->input('typeName'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('master_data_piutang')->with('success', 'Item berhasil ditambahkan.');
    }

   
}
