<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('pembelian_id');
            // $table->foreign('pembelian_id')->references('id')->on('pembelian')->onDelete('cascade');
            $table->foreignId('pembelian_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('barang_id');
            $table->double('harga_beli', 11, 2);
            $table->integer('jumlah');
            $table->double('subtotal', 13, 2);
            $table->boolean('status')->default(TRUE);
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
        Schema::dropIfExists('detail_pembelians');
    }
}
