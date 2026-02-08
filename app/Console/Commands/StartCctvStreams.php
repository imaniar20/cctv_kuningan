<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Camera;
use Illuminate\Support\Facades\Log;

class StartCctvStreams extends Command
{
    protected $signature = 'cctv:start {id?}';
    protected $description = 'Menjalankan ffmpeg untuk semua kamera atau 1 kamera spesifik';

    public function handle()
    {
        // Ambil ID dari argument (optional)
        $id = $this->argument('id');

        // Jika ada ID, ambil 1 kamera saja. Jika tidak, ambil semua.
        $cameras = $id ? Camera::where('id', $id)->get() : Camera::all();

        if ($cameras->isEmpty()) {
            $this->error('❌ Tidak ada kamera ditemukan.');
            return 1;
        }

        foreach ($cameras as $cam) {
            $this->startCamera($cam);
        }

        $this->info("✅ Selesai! Total {$cameras->count()} kamera dijalankan.");
        return 0;
    }

    private function startCamera($cam)
    {
        // Path folder stream untuk kamera ini
        $dirPath = public_path("stream/{$cam->slug}");

        // Hapus folder lengkap dengan fungsi rekursif
        $this->deleteDirectory($dirPath);

        // Beri jeda sebelum membuat folder baru
        usleep(50000); // 0.05 detik

        // Buat folder baru
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true);
            $this->info("📁 Folder {$cam->slug} dibuat ulang.");
        }

        // Sisanya sama seperti sebelumnya...
        $outputPath = "{$dirPath}/playlist.m3u8";
        $segmentPath = "{$dirPath}/segment_%Y%m%d_%H%M%S.ts";

        $cmd = sprintf(
            'ffmpeg -loglevel error -i "%s" -c:v copy -preset ultrafast -tune zerolatency -hls_time 2 -hls_list_size 2 -hls_flags delete_segments -hls_segment_filename "%s" -strftime 1 "%s"',
            $cam->rtsp_url,
            $segmentPath,
            $outputPath
        );

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            pclose(popen("start /B " . $cmd, "r"));
        } else {
            exec($cmd . " > /dev/null 2>&1 &");
        }

        $this->info("🎥 {$cam->name} → {$outputPath}");
        Log::info("CCTV started: {$cam->slug} (ID: {$cam->id})");
    }

    // Tambahkan fungsi helper untuk menghapus direktori secara rekursif
    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) {
            return;
        }

        // Hentikan proses FFmpeg yang mungkin masih berjalan
        $this->killFfmpegProcess($dir);

        // Tunggu sebentar untuk memastikan proses mati
        usleep(100000);

        // Hapus semua file dan subdirectory
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $this->deleteDirectory($path);
            } else {
                @unlink($path);
            }
        }

        // Hapus directory utama
        @rmdir($dir);

        $this->info("🗑️  Folder dihapus: " . basename($dir));
    }

    // Fungsi untuk menghentikan proses FFmpeg yang terkait
    private function killFfmpegProcess($dirPath)
    {
        $folderName = basename($dirPath);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows: gunakan taskkill
            exec("taskkill /F /IM ffmpeg.exe 2>nul 1>nul");
        } else {
            // Linux: kill proses ffmpeg yang terkait folder ini
            exec("pkill -f 'ffmpeg.*{$folderName}' 2>/dev/null");
            // Tunggu sebentar
            usleep(50000);
            // Kill lagi untuk memastikan
            exec("pkill -9 -f 'ffmpeg.*{$folderName}' 2>/dev/null");
        }
    }
}