<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Camera;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class AutoRestartCctv extends Command
{
    protected $signature = 'cctv:auto-restart';
    protected $description = 'Auto restart offline CCTV cameras';

    public function handle()
    {
        $cameras = Camera::all();
        $offlineCount = 0;

        $this->info("🔍 Checking camera status...");

        foreach ($cameras as $cam) {
            $file = public_path("stream/{$cam->slug}/playlist.m3u8");
            $status = 'offline';
            
            if (file_exists($file)) {
                $lastModified = filemtime($file);
                $timeDiff = time() - $lastModified;
                
                if ($timeDiff <= 15) {
                    $status = 'online';
                    $this->info("  🟢 {$cam->name} - Online (updated {$timeDiff}s ago)");
                } else {
                    $this->warn("  🔴 {$cam->name} - Offline (last update {$timeDiff}s ago)");
                }
            } else {
                $this->warn("  🔴 {$cam->name} - Offline (file not found)");
            }

            // Jika offline, restart
            if ($status === 'offline') {
                $offlineCount++;
                $this->info("  🔄 Restarting {$cam->name}...");
                Log::warning("Auto-restarting camera: {$cam->name} ({$cam->slug})");
                
                // Jalankan command restart untuk kamera ini
                Artisan::call('cctv:start', ['id' => $cam->id]);
                
                $this->info("  ✅ Restart command sent for {$cam->name}");
                
                // Delay 10 detik sebelum restart kamera berikutnya
                if ($offlineCount < count($cameras->where('status', 'offline'))) {
                    $this->info("  ⏳ Waiting 10 seconds before next restart...");
                    sleep(10);
                }
            }
        }

        if ($offlineCount > 0) {
            $this->info("\n✅ Auto-restart completed. Restarted {$offlineCount} camera(s).");
            Log::info("Auto-restart completed. Restarted {$offlineCount} camera(s).");
        } else {
            $this->info("\n✅ All cameras online. No restart needed.");
        }

        return 0;
    }
}