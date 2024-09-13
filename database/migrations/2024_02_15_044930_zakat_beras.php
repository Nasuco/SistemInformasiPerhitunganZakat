<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('zakat_beras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('muzakki_id');
            $table->decimal('kilogram', 10, 1);
            $table->integer('jumlah_keluarga');
            $table->decimal('jumlah_kg', 10, 1);
            $table->date('tanggal_penerimaan');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('muzakki_id')->references('id')->on('muzakki');
        });
    }

    public function down()
    {
        Schema::dropIfExists('zakat_beras');
    }
};
