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
        Schema::create('ip_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ip_id');
            $table->string('requestd_by');
            $table->string('compleated_date');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('ip_id')->references('id')->on('ips')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_details');
    }
};
