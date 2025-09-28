<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

use App\Models\Camera;
use App\Models\Location;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::with('location')->get();
        $locations = Location::with('camera')->get();
        
        $data = [
            'head' => 'Dashboard',
            'menu' => 'Dashboard',
            'cameras' => $cameras,
            'locations' => $locations
        ];
        return view('dashboard/index')->with($data);
    }
}
