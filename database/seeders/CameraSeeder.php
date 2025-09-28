<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CameraSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cameras')->insert([
            'id' => 1,
            'id_location' => 1,
            'name' => 'Utara Pemda',
            'rtsp_url' => 'rtsp://admin:Admin123@172.16.200.2:554/Streaming/Channels/101',
            'slug' => 'utara_pemda',
            'lat' => '-6.976071342567147',
            'lng' => '108.4837267744451',
            'created_at' => '2025-09-28 11:10:24',
            'updated_at' => '2025-09-28 11:10:24',
        ]);

        DB::table('cameras')->insert([
            'id' => 2,
            'id_location' => 1,
            'name' => 'Depan Pemda',
            'rtsp_url' => 'rtsp://admin:hikvision123@172.16.200.5/Streaming/Channels/101',
            'slug' => 'depan_pemda',
            'lat' => '-6.976506188897671',
            'lng' => '108.48339876536056',
            'created_at' => '2025-09-28 11:10:24',
            'updated_at' => '2025-09-28 11:10:24',
        ]);
    }
}