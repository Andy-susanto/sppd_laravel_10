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
        Schema::create('data_perdins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('surat_dari');
            $table->string('nomor_surat');
            $table->date('tgl_surat');
            $table->text('perihal');
            $table->string('no_spt');
            $table->unsignedBigInteger('tanda_tangan_id');
            $table->text('maksud');
            $table->integer('lama');
            $table->date('tgl_berangkat');
            $table->date('tgl_kembali');
            $table->unsignedBigInteger('alat_angkut_id');
            $table->unsignedBigInteger('jenis_perdin_id');
            $table->unsignedBigInteger('kedudukan_id');
            $table->unsignedBigInteger('tujuan_id');
            $table->text('lokasi');
            $table->unsignedBigInteger('pegawai_diperintah_id');
            $table->string('biaya');
            $table->string('jumlah_pegawai');
            $table->text('keterangan');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_perdins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
