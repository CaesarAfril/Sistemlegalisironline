<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemesanan', function (Blueprint $table) {
            $table->id('id');
            $table->string('pengiriman',255);
            $table->string('status',255);
            $table->unsignedBigInteger('id_berkas');
            $table->timestamps();

            $table->foreign('id_berkas')->references('id')->on('tb_berkas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pemesanan');
    }
}
