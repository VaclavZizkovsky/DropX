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
        Schema::create('file_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('state')->default('sent');
            $table->unsignedBigInteger('from_device_id');
            $table->foreign('from_device_id')
                ->references('id')
                ->on('devices');
            $table->unsignedBigInteger('to_device_id');
            $table->foreign('from_device_id')
                ->references('id')
                ->on('devices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_transfers');
    }
};
