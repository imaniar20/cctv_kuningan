<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use voku\helper\AntiXSS;
use Illuminate\Support\Facades\Storage;

use App\Models\Location;

class LocationController extends Controller
{
    public function Store(Request $request)
    {
        $antiXss = new AntiXSS();

        $name = $antiXss->xss_clean($request->input('name'));

        $cleanedData = [
            'nama' => $name,
        ];

        $add = Location::create($cleanedData);

        return redirect('/dashboard')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $antiXss = new AntiXSS();
        $camera = Location::findOrFail($antiXss->xss_clean($request->input('id_location')));

        $name = $antiXss->xss_clean($request->input('edit_name_location'));
        
        $cleanedData = [
            'nama' => $name
        ];

        $update = $camera->update($cleanedData);

        return redirect('/dashboard')->with('success', 'Lokasi berhasil diubah.');
    }

    public function destroy(Request $request)
    {
        $data = Location::with('camera')->findOrFail($request->id);

        foreach ($data->camera as $camera) {
            $this->deleteFileIfExists($camera->foto);
            $camera->delete();
        }

        $data->delete();

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
}
