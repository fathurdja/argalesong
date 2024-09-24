<?php

namespace App\Http\Controllers;

use App\Models\piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UmurPiutangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            // Fetch data with search filter
            $data = DB::table('detailpiutang')
                ->join('customer', 'detailpiutang.idpelanggan', '=', 'customer.id_Pelanggan')
                ->join('pelanggan', 'customer.idtypepelanggan', '=', 'pelanggan.idtypepelanggan')
                ->select('detailpiutang.*', 'customer.name as nama_customer', 'pelanggan.namatipepelanggan as tipe_pelanggan')
                ->where('customer.name', 'LIKE', "%{$search}%")
                ->orWhere('detailpiutang.idpelanggan', 'LIKE', "%{$search}%")
                ->get();

            // Group the data
            $grouped_data = $this->groupData($data);
        } else {
            // Fetch all data if no search query
            $data = DB::table('detailpiutang')
                ->join('customer', 'detailpiutang.idpelanggan', '=', 'customer.id_Pelanggan')
                ->join('tipepelanggan', 'customer.idtypepelanggan', '=', 'tipepelanggan.kodetype')
                ->select('detailpiutang.*', 'customer.name as nama_customer', 'tipepelanggan.name as tipe_pelanggan')
                ->get();

            // Group the data
            $grouped_data = $this->groupData($data);
        }

        return view('umurPiutang.umurPiutang', compact('grouped_data', 'search'));
    }


    /**
     * Groups the data by tipe_pelanggan and jhari ranges.
     *
     * @param  \Illuminate\Support\Collection  $data
     * @return array
     */
    private function groupData($data)
    {
        $grouped_data = [];
        foreach ($data as $item) {
            $group_name = $item->tipe_pelanggan;

            if (!isset($grouped_data[$group_name])) {
                $grouped_data[$group_name] = [
                    'kurang_30' => [],
                    '30_60' => [],
                    '60_90' => [],
                    '90_120' => [],
                    'lebih_120' => [],
                ];
            }

            if ($item->jhari <= 30) {
                $grouped_data[$group_name]['kurang_30'][] = $item;
            } elseif ($item->jhari <= 60) {
                $grouped_data[$group_name]['30_60'][] = $item;
            } elseif ($item->jhari <= 90) {
                $grouped_data[$group_name]['60_90'][] = $item;
            } elseif ($item->jhari <= 120) {
                $grouped_data[$group_name]['90_120'][] = $item;
            } else {
                $grouped_data[$group_name]['lebih_120'][] = $item;
            }
        }

        return $grouped_data;
    }
}
