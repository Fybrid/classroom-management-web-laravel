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
            $table->string('number')->unique();
            $table->string('floor');
            $table->timestamps();
        });

        $now = now();

        DB::table('rooms')->insert([
            ['number' => 'B101', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B104', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B112', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
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

        Schema::create('room_status', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->date('date');
            $table->tinyInteger('period');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->unique(['room_id', 'date', 'period']);
        });
        
        DB::table('room_status')->insert([
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 1, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 2, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 3, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 4, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 5, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['room_id' => 1, 'date' => '2024/8/10', 'period' => 6, 'status' => 0, 'created_at' => $now, 'updated_at' => $now,],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_status');

        Schema::dropIfExists('reservations');

        Schema::dropIfExists('rooms');
    }
};
