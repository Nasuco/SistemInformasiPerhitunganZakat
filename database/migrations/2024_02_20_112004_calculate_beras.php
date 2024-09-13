<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calculate_beras', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_mustahik');
            $table->decimal('total_per_kg', 10, 1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calculate_beras');
    }
};
