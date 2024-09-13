<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('infaq', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat_rt')->nullable();
            $table->decimal('jumlah_rupiah', 15, 2);
            $table->date('tanggal_penerimaan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('infaq');
    }
};