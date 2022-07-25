<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('kode_booking')->primary();
            $table->string('nama_customer');
            $table->string('email_customer')->nullable();
            $table->string('no_handphone');
            $table->string('no_polisi');
            $table->unsignedBigInteger('id_kendaraan');
            $table->string('jenis_transmisi');
            $table->unsignedBigInteger('id_dealer');
            $table->dateTime('tgl_booking');
            $table->string('jenis_pekerjaan');
            $table->string('jenis_layanan');
            $table->string('keterangan_customer')->nullable();
            $table->string('status');
            $table->string('keterangan_cco')->nullable();
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraans');
            $table->foreign('id_dealer')->references('id_dealer')->on('dealers');
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
        Schema::dropIfExists('bookings');
    }
};
