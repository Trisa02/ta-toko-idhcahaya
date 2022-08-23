<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $data['admin'] = DB::table('admins')->where('id_admin', Session('id_admin'))->first();

        return view('backend.laporan.index', $data);
    }

    public function cetak(Request $request)
    {
        if ($request->bulan != '') {
            $transaction = DB::table('transaksis')
                ->join('members', 'transaksis.id', '=', 'members.id')
                ->whereMonth('transaction_time', $request->bulan)
                ->whereYear('transaction_time', $request->tahun)
                ->where('transaction_status', $request->status)
                ->orderBy('transaction_time', 'DESC')->get();
        } else{
            $transaction = DB::table('transaksis')
                ->join('members', 'transaksis.id', '=', 'members.id')
                ->whereYear('transaction_time', $request->tahun)
                ->where('transaction_status', $request->status)
                ->orderBy('transaction_time', 'DESC')->get();
        }

        return view('backend.laporan.cetak', compact('transaction'));
    }
}
