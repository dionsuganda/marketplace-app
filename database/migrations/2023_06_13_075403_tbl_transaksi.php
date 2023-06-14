<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_transaksi');
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_product');
            $table->integer('qty');
            $table->integer('total_harga');
            $table->enum('status_payment', ['payment', 'process', 'invalid'])->default('process');
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
        //
    }
}
