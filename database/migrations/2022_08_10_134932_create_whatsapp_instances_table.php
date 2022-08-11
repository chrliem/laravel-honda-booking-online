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
        Schema::create('whatsapp_instances', function (Blueprint $table) {
            $table->string('instance_id')->primary();
            $table->unsignedBigInteger('id_dealer');
            $table->string('token');
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
        Schema::dropIfExists('whatsapp_instances');
    }
};
