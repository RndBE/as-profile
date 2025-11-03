<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ClientsController extends Controller
{
    public function index()
    {
        $data = [
            'clients' => Clients::orderBy('nama', 'asc')->get(),
        ];
        return view('Admin.clients.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('logo')) {
            $originalName = $request->file('logo')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imageName = 'klien/' . $fileName;
            $storagePath = storage_path('app/public/' . $imageName);

            // Pastikan direktori tujuan ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Baca file asli dan simpan sebagai webp
            $imageFromRequest = $request->file('logo')->getRealPath();

            Image::read($imageFromRequest)  // Gunakan Intervention Image
                ->toWebp()
                ->save($storagePath);
        }

        Clients::create([
            'nama' => $request->nama,
            'logo' => $imageName,
        ]);

        toast('Berhasil menambahkan data!','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $clients = Clients::findOrFail($id);

        $clients->nama = $request->nama;

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($clients->logo && Storage::disk('public')->exists($clients->logo)) {
                Storage::disk('public')->delete($clients->logo);
            }

            // Generate nama baru
            $originalName = $request->file('logo')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imagePath = 'klien/' . $fileName;
            $storagePath = storage_path('app/public/' . $imagePath);

            // Pastikan folder ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Konversi dan simpan logo
            $imageFromRequest = $request->file('logo')->getRealPath();

            Image::read($imageFromRequest)
                ->toWebp()
                ->save($storagePath);

            $clients->logo = $imagePath;
        }

        $clients->save();
        toast('Berhasil mengubah data!','success');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $clients = Clients::findOrFail($id);

        if ($clients->logo && Storage::disk('public')->exists($clients->logo)) {
            Storage::disk('public')->delete($clients->logo);
        }

        $clients->delete();

        toast('Berhasil menghapus data!','success');
        return redirect()->back();
    }
}
