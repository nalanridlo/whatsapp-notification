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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('phone_number');
            $table->date('tanggalLahir');
            $table->date('reminder_date');
            $table->date('expire_date')->nullable();
            $table->string('message')->default('pesan ini merupakan peringatan bahwa anda akan expired date');
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
