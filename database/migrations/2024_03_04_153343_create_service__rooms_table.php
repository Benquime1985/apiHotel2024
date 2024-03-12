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
        Schema::create('service__rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serv_id');
            $table->unsignedBigInteger('room_id');
            $table->foreign('serv_id')
                    ->references('id')
                    ->on('services')
                    ->onUpd('cascade')
                    ->onDelete('restrict');
            $table->foreign('room_id')
                    ->references('id')
                    ->on('rooms')
                    ->onUpd('cascade')
                    ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service__rooms');
    }
};
