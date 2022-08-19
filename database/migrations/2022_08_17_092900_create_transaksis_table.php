<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('kurir');
            $table->integer('ongkir');
            $table->integer('total_bayar');
            $table->string('order_id');
            $table->string('status_code');
            $table->string('status_message');
            $table->string('transaction_id');
            $table->string('payment_type');
            $table->string('transaction_time');
            $table->string('transaction_status');
            $table->string('fraud_status');
            $table->string('nomor_resi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
