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
            'rtsp_url' => 'rtsp://admin:Kuninganmaju2023@172.16.200.7:554/h264_stream',
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
            'rtsp_url' => 'rtsp://admin:Mitrakita2024@192.168.1.64:554/cam0/mjpeg',
            'slug' => 'depan_pemda',
            'lat' => '-6.976506188897671',
            'lng' => '108.48339876536056',
            'created_at' => '2025-09-28 11:10:24',
            'updated_at' => '2025-09-28 11:10:24',
        ]);
    }
}