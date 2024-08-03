<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('floor');
            $table->unsignedMediumInteger('capacity');
            $table->timestamps();
        });

        $now = now();

        DB::table('rooms')->insert([
            ['number' => 'B101', 'floor' => 'B1', 'capacity' => '100', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B104', 'floor' => 'B1', 'capacity' => '20', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B112', 'floor' => 'B1', 'capacity' => '24', 'created_at' => $now, 'updated_at' => $now,],
        ]);

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('personal_id');
            $table->foreign('personal_id')->references('personal_id')->on('users');
            $table->unsignedBigInteger('room_id');
            $table->date('date');
            $table->tinyInteger('period');
            $table->timestamps();
            $table->unique(['room_id', 'date', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');

        Schema::dropIfExists('rooms');
    }
};
