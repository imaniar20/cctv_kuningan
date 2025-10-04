<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CameraSeeder extends Seeder
{
    public function run()
    {
        $cameras = [
            [
                'name' => 'Perempatan Pasar Darurat',
                'slug' => Str::slug('Perempatan Pasar Darurat'),
                'rtsp_url' => 'rtsp://admin:Kuninganmaju2023@172.16.200.6:554/h264_stream',
                'lat' => '-6.979111',
                'lng' => '108.472485',
            ],
            [
                'name' => 'Perempatan Ciporang',
                'slug' => Str::slug('Perempatan Ciporang'),
                'rtsp_url' => 'rtsp://admin:Kuninganmaju2023@172.16.200.8:554/h264_stream',
                'lat' => '-6.969934',
                'lng' => '108.502416',
            ],
            [
                'name' => 'Tugu Sajati',
                'slug' => Str::slug('Tugu Sajati'),
                'rtsp_url' => 'rtsp://admin:Kuninganmaju2023@172.16.200.7:554/h264_stream',
                'lat' => '-6.962983',
                'lng' => '108.514519',
            ],
            [
                'name' => 'Tugu Ikan',
                'slug' => Str::slug('Tugu Ikan'),
                'rtsp_url' => 'rtsp://admin:Mitrakita2024@192.168.1.64:554/cam0/mjpeg',
                'lat' => '-6.849224',
                'lng' => '108.508124',
            ],
            [
                'name' => 'Pemda Utara',
                'slug' => Str::slug('Pemda Utara'),
                'rtsp_url' => 'rtsp://admin:Admin123@172.16.200.2:554/h264_stream',
                'lat' => '-6.976039416002021',
                'lng' => '108.48372000266086',
            ],
            [
                'name' => 'Depan Pendopo',
                'slug' => Str::slug('Depan Pendopo'),
                'rtsp_url' => 'rtsp://admin:Diskominfo2025@172.16.200.30:554/H264',
                'lat' => '-6.976541',
                'lng' => '108.483372',
            ],
            [
                'name' => 'Taman Dahlia',
                'slug' => Str::slug('Taman Dahlia'),
                'rtsp_url' => 'rtsp://admin:hikvision123@172.16.200.5:554/H264',
                'lat' => '-6.976440',
                'lng' => '108.483467',
            ],
            [
                'name' => 'Oleced',
                'slug' => Str::slug('Oleced'),
                'rtsp_url' => 'rtsp://mkb:Mitrakita2022@172.16.200.10:554/h264_stream',
                'lat' => '-6.992470',
                'lng' => '108.567856',
            ],
            [
                'name' => 'Kadugede',
                'slug' => Str::slug('Kadugede'),
                'rtsp_url' => 'rtsp://mkb:Mitrakita2022@172.16.200.9:554/h264_stream',
                'lat' => '-7.004740648348832',
                'lng' => '108.4546721897343',
            ],
            [
                'name' => 'Pertokoan Siliwangi',
                'slug' => Str::slug('Pertokoan Siliwangi'),
                'rtsp_url' => 'rtsp://admin:112898aiz@10.5.1.69/video.h264',
                'lat' => '-6.9820308601761125',
                'lng' => '108.4775157522436',
            ],
            [
                'name' => 'Koridor Siliwangi Selatan',
                'slug' => Str::slug('Koridor Siliwangi Selatan'),
                'rtsp_url' => 'rtsp://admin:Mitrakita2024@10.5.1.59:554/cam0/mjpeg',
                'lat' => '-6.981654019956326',
                'lng' => '108.47791760978981',
            ],
            [
                'name' => 'Koridor Siliwangi Utara',
                'slug' => Str::slug('Koridor Siliwangi Utara'),
                'rtsp_url' => 'rtsp://admin:Mitrakita2024@10.5.0.227:554/cam0/mjpeg',
                'lat' => '-6.981991192793326',
                'lng' => '108.47754461494422',
            ],
            [
                'name' => 'Citamba Siliwangi',
                'slug' => Str::slug('Citamba Siliwangi'),
                'rtsp_url' => 'rtsp://admin:Mitrakita2024@172.16.200.11/cam/realmonitor?channel=1&subtype=00&authbasic=YWRtaW46TWl0cmFraXRhMjAyNA==',
                'lat' => '-6.9806174732299935',
                'lng' => '108.47877253401651',
            ],
        ];

        foreach ($cameras as $cam) {
            DB::table('cameras')->insert([
                'id_location' => 1,
                'name'       => $cam['name'],
                'slug'       => $cam['slug'],
                'rtsp_url'   => $cam['rtsp_url'],
                'lat'        => $cam['lat'],
                'lng'        => $cam['lng'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}