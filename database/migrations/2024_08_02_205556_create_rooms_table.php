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
            // $table->unsignedMediumInteger('capacity');
            $table->timestamps();
        });

        $now = now();

        DB::table('rooms')->insert([
            ['number' => 'B101', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B104', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B112', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B113', 'floor' => 'B1', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '901' , 'floor' => '9' , 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1001', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1002', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1003', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1004', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1005', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1006', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1007', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1008', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1009', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1010', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1011', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1012', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1013(CG)', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1014(L)', 'floor' => '10', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1101', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1102', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1103', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1104', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1105', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1106', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1107', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1108', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1109', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1110', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1111', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1112', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1113(L)', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1114(L)', 'floor' => '11', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1201', 'floor' => '12', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1202', 'floor' => '12', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1204', 'floor' => '12', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1206', 'floor' => '12', 'created_at' => $now, 'updated_at' => $now,],
            ['number' => '1207', 'floor' => '12', 'created_at' => $now, 'updated_at' => $now,],
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

        DB::table('reservations')->insert([
            ['personal_id' => '234567', 'room_id' => '2', 'date' => '2024/8/10', 'period' => 3, 'created_at' => $now, 'updated_at' => $now,],
        ]);

        Schema::create('room_status', function (Blueprint $table){
            $table->id();
            $table->string('number');
            $table->foreign('number')->references('number')->on('rooms');
            $table->date('date');
            $table->tinyInteger('period');
            $table->tinyInteger('room_status');
            $table->timestamps();
            $table->unique(['number', 'date', 'period']);
        });

        DB::table('room_status')->insert([
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 1, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 2, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 3, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 4, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 5, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
            ['number' => 'B101', 'date' => '2024/8/10', 'period' => 6, 'room_status' => 0, 'created_at' => $now, 'updated_at' => $now,],
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
