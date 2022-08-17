<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelilangsungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belilangsungs', function (Blueprint $table) {
            $table->increments('id_beli');
            $table->integer('id');
            $table->integer('id_barang');
            $table->date('tanggal');
            $table->integer('qty');
            $table->float('total');
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
        Schema::dropIfExists('belilangsungs');
    }
}
