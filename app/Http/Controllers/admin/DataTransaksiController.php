<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTransaksiController extends Controller
{
    public function index()
    {
        $data['admin'] = DB::table('admins')->where('id_admin', Session('id_admin'))->first();
        $data['transaction'] = DB::table('transaksis')->join('members', 'transaksis.id', '=', 'members.id')->orderBy('transaction_time', 'DESC')->get();
        return view('backend.transaksi.index', $data);
    }

    public function store_resi(Request $request)
    {
        DB::table('transaksis')->where('order_id', $request->order_id)
            ->update([
                'nomor_resi' => $request->nomor_resi,
            ]);
        return redirect()->back()->with('success', 'berhasil di input');
    }

    public function delete($id)
    {
        DB::table('transaksis')->where('id_transaksi', $id)
            ->delete();

        return redirect()->back()->with('success', 'berhasil di hapus');
    }
}
