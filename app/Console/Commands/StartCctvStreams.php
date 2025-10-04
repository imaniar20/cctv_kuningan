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
            $dirPath = public_path("stream/{$cam->slug}");
            
            if (is_dir($dirPath)) {
                $files = glob("$dirPath/*");
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            } else {
                mkdir($dirPath, 0777, true);
            }

            $outputPath = $dirPath . "/playlist.m3u8";
            $segmentPath = $dirPath . "/segment_%Y%m%d_%H%M%S.ts";

            $cmd = "ffmpeg -i \"{$cam->rtsp_url}\" "
                    . "-c:v copy -preset ultrafast -tune zerolatency "
                    . "-hls_time 2 -hls_list_size 2 -hls_flags delete_segments "
                    . "-hls_segment_filename \"{$segmentPath}\" "
                    . "-strftime 1 "
                    . "\"{$outputPath}\"";

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                pclose(popen("start /B " . $cmd, "r"));
            } else {
                exec($cmd . " > /dev/null 2>&1 &");
            }

            $this->info("Streaming {$cam->name} dijalankan ke {$outputPath}");
        }
    }
}
