<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Camera;

class StartCctvStreams extends Command
{
    protected $signature = 'cctv:start';
    protected $description = 'Menjalankan ffmpeg untuk semua kamera';

    public function handle()
    {
        $cameras = Camera::all();

        foreach ($cameras as $cam) {
            $outputPath = public_path("stream/{$cam->slug}/playlist.m3u8");

            @mkdir(dirname($outputPath), 0777, true);

            $cmd = [
                'ffmpeg',
                '-i', $cam->rtsp_url,
                '-c:v', 'libx264',
                '-preset', 'ultrafast',
                '-tune', 'zerolatency',
                '-hls_time', '2',
                '-hls_list_size', '5',
                '-hls_flags', 'delete_segments',
                '-f', 'hls',
                $outputPath
            ];

            $process = new Symfony\Component\Process\Process($cmd);
            $process->setTimeout(null);
            $process->run(function ($type, $buffer) {
                echo $buffer; // tampilkan log ffmpeg di terminal
            });
        }
    }
}
