<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Models\Camera;

class CameraController extends Controller
{
    public function index()
    {
        // $cameras = Camera::with('location')->get();

        // $data = [
        //     'head' => 'Dashboard',
        //     'menu' => 'Dashboard',
        //     'cameras' => $cameras
        // ];
        // return view('dashboard/index')->with($data);
    }

    public function Store(Request $request)
    {
        $antiXss = new AntiXSS();

        $name = $antiXss->xss_clean($request->input('name'));
        $slug = Str::slug($name);

        $originalSlug = $slug;
        $counter = 1;

        while (Camera::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            // nama file aman & unik
            $filename = Str::slug($name) . '-' . time() . '.' . $file->getClientOriginalExtension();

            $fotoPath = $file->storeAs(
                'cctv/foto',
                $filename,
                'public'
            );
        }

        $cleanedData = [
            'id_location' => $antiXss->xss_clean($request->input('lokasi')),
            'name' => $name,
            'foto' => $fotoPath ?? null,
            'slug' => $slug,
            'rtsp_url' => $antiXss->xss_clean($request->input('rtsp')),
            'lat' => $antiXss->xss_clean($request->input('lat')),
            'lng' => $antiXss->xss_clean($request->input('lng')),
        ];

        $add = Camera::create($cleanedData);

        return redirect('/dashboard')->with('success', 'Cctv berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $antiXss = new AntiXSS();
        $camera = Camera::findOrFail($antiXss->xss_clean($request->input('id_cctv')));

        $name = $antiXss->xss_clean($request->input('edit_name'));
        $slug = Str::slug($name);

        $originalSlug = $slug;
        $counter = 1;

        while (Camera::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $fotoPath = $camera->foto;
        if ($request->hasFile('edit_foto')) {
            $this->deleteFileIfExists($camera->foto);

            $file = $request->file('edit_foto');

            // nama file aman & unik
            $filename = Str::slug($name) . '-' . time() . '.' . $file->getClientOriginalExtension();

            $fotoPath = $file->storeAs(
                'cctv/foto',
                $filename,
                'public'
            );
        }

        $cleanedData = [
            'id_location' => $antiXss->xss_clean($request->input('edit_lokasi')),
            'name' => $name,
            'foto' => $fotoPath ?? null,
            'slug' => $slug,
            'rtsp_url' => $antiXss->xss_clean($request->input('edit_rtsp')),
            'lat' => $antiXss->xss_clean($request->input('edit_lat')),
            'lng' => $antiXss->xss_clean($request->input('edit_lng')),
        ];

        $update = $camera->update($cleanedData);

        return redirect('/dashboard')->with('success', 'Cctv berhasil diubah.');
    }

    public function destroy(Request $request)
    {
        $data = Camera::findOrFail($request->id);

        $data->delete();
        
        $this->deleteFileIfExists($data->foto);

        session()->flash('success', 'Data berhasil dihapus.');

        return response()->json(['success' => true]);
    }

    private function deleteFileIfExists($filePath)
    {
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return true;
        }
        return false;
    }

    public function statusCameras()
    {
        $cameras = Camera::all();
        $result = [];

        foreach ($cameras as $cam) {
            $file = public_path("stream/{$cam->slug}/playlist.m3u8");

            $status = 'offline';
            if (file_exists($file)) {
                $lastModified = filemtime($file);
                if (time() - $lastModified <= 15) {
                    $status = 'online';
                }
            }

            $result[] = [
                'name' => $cam->name,
                'slug' => $cam->slug,
                'status' => $status,
            ];
        }

        return response()->json($result);
    }

    public function statusCamerasDash()
    {
        $cameras = Camera::all();
        $result = [];
        $onlineCount = 0;

        foreach ($cameras as $cam) {
            $file = public_path("stream/{$cam->slug}/playlist.m3u8");

            $status = 'offline';
            if (file_exists($file)) {
                $lastModified = filemtime($file);
                if (time() - $lastModified <= 15) {
                    $status = 'online';
                    $onlineCount++;
                }
            }

            $result[] = [
                'name' => $cam->name,
                'slug' => $cam->slug,
                'status' => $status,
            ];
        }

        return response()->json([
            'cameras' => $result,
            'online' => $onlineCount,
            'total' => $cameras->count(),
        ]);
    }

    public function start(Request $request)
    {
        $request->validate(['slug' => 'required|string']);
        $slug = $request->input('slug');

        $cacheKey = "cctv_attempt_{$slug}";
        $added = Cache::add($cacheKey, true, 10);

        if (!$added) {
            return response()->json([
                'status' => 'throttled',
                'message' => 'Tunggu 10 detik sebelum mencoba lagi.'
            ], 429);
        }

        $cam = Camera::where('slug', $slug)->first();

        if (!$cam) {
            return response()->json([
                'status' => 'error',
                'message' => 'Camera not found.'
            ], 404);
        }

        try {
            // Jalankan command dengan ID kamera
            Artisan::call('cctv:start', ['id' => $cam->id]);

            Log::info("CCTV start triggered via API for {$slug}");

            return response()->json([
                'status' => 'started',
                'message' => 'Camera started successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error("Failed to start camera {$slug}: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to start camera: ' . $e->getMessage()
            ], 500);
        }
    }

}
