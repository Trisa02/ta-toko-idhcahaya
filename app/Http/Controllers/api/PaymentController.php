<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment_handler(Request $request)
    {
        // dd('tes');
        // tangkap data dri postman
        $data = json_decode($request->getContent());
        //ambil data dri database tb_transaksis where orderid = order_id postman
        $order = DB::table('transaksis')->where('order_id', $data->order_id)->first();

        $signature_key = hash('sha512', $data->order_id.$data->status_code.$data->gross_amount.'SB-Mid-server-JHaJcvub_uXNh50dn4rZAI3c');

        if($signature_key == $data->signature_key){
            //update tb_transaksi
             DB::table('transaksis')->where('order_id', $data->order_id)
            ->update([
                'status_code'=>$data->status_code,
                'status_message'=>$data->status_message,
                'transaction_status'=>$data->transaction_status,
            ]);

            DB::table('belilangsungs')->where('id', $order->id)->delete();

            return response()->json(['message' => 'sukses']);


        }else{
            return response()->json(['message' => 'invalid signture key']);
        }
        //rumus order_id+status_code+gross_amount+server_key -> sha512 -> hash
        //dibandingkan signature key dri postman dgn signature key buatan kita
        //jika sama proses
        //jika tidak tolak
    }
}
