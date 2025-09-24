<?php

namespace App\Http\Controllers;

use App\Models\Camera;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::all();
        return view('cameras.index', compact('cameras'));
    }

    public function show(Camera $camera)
    {
        return view('cameras.show', compact('camera'));
    }
}
