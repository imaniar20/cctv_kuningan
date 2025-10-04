<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use voku\helper\AntiXSS;
use Illuminate\Support\Str;

use App\Models\Camera;
use App\Models\Location;

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

    public function Store(Request $request){
        $antiXss = new AntiXSS();

        $name = $antiXss->xss_clean($request->input('name'));
        $slug = Str::slug($name); 

        $originalSlug = $slug;
        $counter = 1;

        while (Camera::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $cleanedData = [
            'id_location' => 1,
            'name' => $name,
            'slug'  => $slug,
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
        $cleanedData = [
            'id_location' => 1,
            'name' => $name,
            'slug'  => $slug,
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

        session()->flash('success', 'Data berhasil dihapus.');

        return response()->json(['success' => true]);
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
                'name'   => $cam->name,
                'slug'   => $cam->slug,
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
                'name'   => $cam->name,
                'slug'   => $cam->slug,
                'status' => $status,
            ];
        }

        return response()->json([
            'cameras' => $result,
            'online'  => $onlineCount,
            'total'   => $cameras->count(),
        ]);
    }

}
