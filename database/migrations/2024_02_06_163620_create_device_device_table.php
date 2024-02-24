<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_device', function (Blueprint $table) {
            $table->unsignedBigInteger('device1_id');
            $table->foreign('device1_id')
                ->references('id')
                ->on('devices')
                ->onDelete('cascade');

            $table->unsignedBigInteger('device2_id');
            $table->foreign('device2_id')
                ->references('id')
                ->on('devices')
                ->onDelete('cascade');

            $table->string('state')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_device');
    }
};
