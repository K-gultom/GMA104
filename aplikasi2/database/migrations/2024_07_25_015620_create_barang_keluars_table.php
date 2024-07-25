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
        Schema::create('barang_keluars', function (Blueprint $table) {
            
            $table->id();
            $table->string('kode_transaksi');
            $table->date('tgl_faktur');
            $table->date('tgl_jatuh_tempo');
            $table->string('pelanggan_id');
            $table->enum('jenis_pembayaran', ['Tunai', 'Kredit']);
            $table->string('barang_id');
            $table->bigInteger('jumlah_beli');
            $table->bigInteger('harga_jual');
            $table->bigInteger('diskon');
            $table->bigInteger('sub_total');
            $table->string('user_id');
            $table->date('tgl_buat');
            $table->string('cabang');
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
        Schema::dropIfExists('barang_keluars');
    }
};
