<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Alumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_alumni', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_lengkap',255);
            $table->string('NIM',255);
            $table->string('program_studi',255);
            $table->string('tahun_lulus',255);
            $table->string('tracer_study',255);
            $table->string('status',255);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
