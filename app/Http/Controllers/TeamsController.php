<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Teams;
use App\Models\Testimonys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class TeamsController extends Controller
{
    public function index()
    {
        $data = [
            'teams' => Teams::orderBy('nama', 'asc')->get(),
        ];
        return view('Admin.teams.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'posisi' => 'required|string|max:255',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'level' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imageName = 'teams/' . $fileName;
            $storagePath = storage_path('app/public/' . $imageName);

            // Pastikan direktori tujuan ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Baca file asli dan simpan sebagai webp
            $imageFromRequest = $request->file('foto')->getRealPath();

            Image::read($imageFromRequest)  // Gunakan Intervention Image
                ->toWebp()
                ->save($storagePath);
        }

        Teams::create([
            'nama' => $request->nama,
            'foto' => $imageName,
            'posisi' => $request->posisi,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'level' => $request->level,
        ]);

        toast('Berhasil menambahkan data!','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'posisi' => 'required|string|max:255',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'level' => 'required|string',
        ]);

        $teams = Teams::findOrFail($id);

        $teams->nama = $request->nama;
        $teams->posisi = $request->posisi;
        $teams->facebook = $request->facebook;
        $teams->instagram = $request->instagram;
        $teams->linkedin = $request->linkedin;
        $teams->level = $request->level;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($teams->foto && Storage::disk('public')->exists($teams->foto)) {
                Storage::disk('public')->delete($teams->foto);
            }

            // Generate nama baru
            $originalName = $request->file('foto')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imagePath = 'teams/' . $fileName;
            $storagePath = storage_path('app/public/' . $imagePath);

            // Pastikan folder ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Konversi dan simpan foto
            $imageFromRequest = $request->file('foto')->getRealPath();

            Image::read($imageFromRequest)
                ->toWebp()
                ->save($storagePath);

            $teams->foto = $imagePath;
        }

        $teams->save();
        toast('Berhasil mengubah data!','success');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $teams = Teams::findOrFail($id);

        if ($teams->foto && Storage::disk('public')->exists($teams->foto)) {
            Storage::disk('public')->delete($teams->foto);
        }

        $teams->delete();

        toast('Berhasil menghapus data!','success');
        return redirect()->back();
    }
}
