<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengiriman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengiriman', function (Blueprint $table) {
            $table->id('id');
            $table->string('alamat',255);
            $table->string('kode_pos',255);
            $table->string('kota',255);
            $table->string('provinsi',255);
            $table->string('jumlah',255);
            $table->string('ekspedisi',255);
            $table->string('harga',255);
            $table->string('resi',255);
            $table->string('status',255);
            $table->unsignedBigInteger('id_pemesan');
            $table->timestamps();

            $table->foreign('id_pemesan')->references('id')->on('tb_pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pengiriman');
    }
}
