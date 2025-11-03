<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Clients;
use App\Models\Testimonys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class TestimonysController extends Controller
{
    public function index()
    {
        $data = [
            'testimonys' => Testimonys::orderBy('nama', 'asc')->get(),
        ];
        return view('Admin.testimonys.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pekerjaan' => 'required|string|max:255',
            'testimoni' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('foto')) {
            $originalName = $request->file('foto')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imageName = 'testimonys/' . $fileName;
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

        Testimonys::create([
            'nama' => $request->nama,
            'foto' => $imageName,
            'pekerjaan' => $request->pekerjaan,
            'testimoni' => $request->testimoni,
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
            'pekerjaan' => 'required|string|max:255',
            'testimoni' => 'required|string',
        ]);

        $testimonys = Testimonys::findOrFail($id);

        $testimonys->nama = $request->nama;
        $testimonys->pekerjaan = $request->pekerjaan;
        $testimonys->testimoni = $request->testimoni;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($testimonys->foto && Storage::disk('public')->exists($testimonys->foto)) {
                Storage::disk('public')->delete($testimonys->foto);
            }

            // Generate nama baru
            $originalName = $request->file('foto')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imagePath = 'testimonys/' . $fileName;
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

            $testimonys->foto = $imagePath;
        }

        $testimonys->save();
        toast('Berhasil mengubah data!','success');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $testimonys = Testimonys::findOrFail($id);

        if ($testimonys->foto && Storage::disk('public')->exists($testimonys->foto)) {
            Storage::disk('public')->delete($testimonys->foto);
        }

        $testimonys->delete();

        toast('Berhasil menghapus data!','success');
        return redirect()->back();
    }
}
