<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('user_id');
            $table->date('tanggal');
            $table->string('no_faktur')->nullable();
            $table->double('total_item', 13, 2);
            $table->double('total_harga', 13, 2);
            $table->double('diskon', 13, 2)->nullable();
            $table->double('ppn', 13, 2)->nullable();
            $table->double('bayar', 13, 2);
            $table->integer('pembayaran');
            $table->string('kode_bayar')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
