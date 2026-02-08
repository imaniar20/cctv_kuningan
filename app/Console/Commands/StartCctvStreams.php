<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Camera;
use Illuminate\Support\Facades\Log;

class StartCctvStreams extends Command
{
    protected $signature = 'cctv:start {id?}';
    protected $description = 'Menjalankan ffmpeg untuk kamera';
    
    public function handle()
    {
        $id = $this->argument('id');
        $cameras = $id ? Camera::where('id', $id)->get() : Camera::all();
        
        foreach ($cameras as $cam) {
            $this->startStreamForCamera($cam);
        }
    }
    
    protected function startStreamForCamera($cam)
    {
        $dirPath = public_path("stream/{$cam->slug}"); // Windows pakai backslash
        
        // Buat folder jika belum ada
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
            $this->info("📁 Created directory: {$dirPath}");
        }
        
        // Hapus file lama (optional)
        $files = glob("{$dirPath}\\*");
        foreach ($files as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
        
        $outputPath = $dirPath . "\\playlist.m3u8";
        $segmentPath = $dirPath . "\\segment_%Y%m%d_%H%M%S.ts";
        
        // FULL PATH ke ffmpeg.exe
        $ffmpegPath = 'ffmpeg.exe'; // Sesuaikan dengan lokasi ffmpeg Anda
        
        // Build command
        $cmd = sprintf(
            '"%s" -loglevel error -i "%s" -c:v copy -preset ultrafast -tune zerolatency -hls_time 2 -hls_list_size 2 -hls_flags delete_segments -hls_segment_filename "%s" -strftime 1 "%s"',
            $ffmpegPath,
            $cam->rtsp_url,
            $segmentPath,
            $outputPath
        );
        
        // Log command untuk debug
        $this->info("🔧 Command: {$cmd}");
        Log::info("CCTV Command for {$cam->slug}: {$cmd}");
        
        // Jalankan di background
        $fullCmd = 'start /B cmd /c "' . $cmd . ' 2>&1"';
        
        $this->info("🚀 Executing: {$fullCmd}");
        
        // Execute
        $handle = popen($fullCmd, 'r');
        
        if ($handle) {
            pclose($handle);
            $this->info("✅ Started ffmpeg for: {$cam->name}");
            Log::info("ffmpeg started for {$cam->slug}");
        } else {
            $this->error("❌ Failed to start ffmpeg for: {$cam->name}");
            Log::error("Failed to start ffmpeg for {$cam->slug}");
        }
        
        // Wait 2 seconds and check if file exists
        sleep(2);
        
        if (file_exists($outputPath)) {
            $this->info("✅ File created: {$outputPath}");
        } else {
            $this->warn("⚠️ File not yet created (might need more time): {$outputPath}");
        }
    }
}