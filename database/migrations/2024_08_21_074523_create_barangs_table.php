<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 10)->unique();
            $table->string('nama_barang');
            $table->string('barcode', 20)->nullable()->unique();
            $table->string('merk')->nullable();
            $table->double('harga_beli', 11, 2);
            $table->double('harga_jual', 11, 2);
            $table->integer('stok');
            $table->integer('min_stok');
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
        Schema::dropIfExists('barangs');
    }
}
