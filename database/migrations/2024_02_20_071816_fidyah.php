<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fidyah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('muzakki_id');
            $table->integer('jumlah_rupiah');
            $table->date('tanggal_penerimaan');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('muzakki_id')->references('id')->on('muzakki');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fidyah');
    }
};
