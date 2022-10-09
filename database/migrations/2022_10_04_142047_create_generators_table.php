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
        Schema::create('generator', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rand_id')->unique()->nullable();
            $table->string('no_surat');
            $table->string('nama_ttd');
            $table->string('tanggal_ttd');
            $table->string('email_no_hp');
            $table->string('perihal');
            $table->rememberToken();
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
        Schema::dropIfExists('generators');
    }
};
