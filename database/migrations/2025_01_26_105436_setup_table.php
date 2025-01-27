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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('nama_lengkap');
            $table->text('alamat');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('tahun');
            $table->timestamps();
        });

        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade')->onUpdate('cascade');

            $table->date('tangal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('status_peminjaman')->default('Belum Dikembalikan');
            $table->timestamps();
        });

        Schema::create('koleksi_pribadi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('ulasan_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->text('ulasan');
            $table->integer('rating');
            $table->timestamps();
        });

        Schema::create('kategori_buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });

        Schema::create('kategori_buku_relasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_buku')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('buku');
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('koleksi_pribadi');
        Schema::dropIfExists('ulasan_buku');
        Schema::dropIfExists('kategori_buku');
        Schema::dropIfExists('kategori_buku_relasi');
    }
};
