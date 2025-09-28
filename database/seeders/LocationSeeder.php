<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            'id' => 1,
            'nama' => 'Pemda Kuningan',
            'created_at' => '2025-09-28 11:01:33',
            'updated_at' => '2025-09-28 11:01:33',
        ]);
    }
}
