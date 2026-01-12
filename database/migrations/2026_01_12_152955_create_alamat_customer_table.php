<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('alamat_customer', function (Blueprint $table) {
        $table->id('id_alamat');
        $table->integer('id_customer');
        $table->string('provinsi');
        $table->string('kota');
        $table->string('kecamatan');
        $table->string('kode_pos', 10);
        $table->text('detail_alamat');
        $table->boolean('is_utama')->default(false);
        $table->timestamps();

        $table->foreign('id_customer')
              ->references('id_customer')
              ->on('customer')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('alamat_customer');
}

};
