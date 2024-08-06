<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        if(App::isLocal()){
            User::factory()->create(['personal_id' => '123456',]);
            User::factory()->create(['personal_id' => '234567',]);
        }
    }
}
