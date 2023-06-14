<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKeranjang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_keranjang');
        Schema::create('tbl_keranjang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_product');
            $table->integer('qty');
            $table->enum('status_checkout', ['Ya', 'Tidak'])->default('Tidak');
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
