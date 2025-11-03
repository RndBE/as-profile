<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CarouselController extends Controller
{
    public function index()
    {
        $data = [
            'carousels' => Carousel::orderBy('judul', 'asc')->get(),
        ];
        return view('Admin.carousels.index', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('gambar')) {
            $originalName = $request->file('gambar')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imageName = 'carousel/' . $fileName;
            $storagePath = storage_path('app/public/' . $imageName);

            // Pastikan direktori tujuan ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Baca file asli dan simpan sebagai webp
            $imageFromRequest = $request->file('gambar')->getRealPath();

            Image::read($imageFromRequest)  // Gunakan Intervention Image
                ->toWebp()
                ->save($storagePath);
        }

        Carousel::create([
            'judul' => $request->judul,
            'sub_judul' => $request->sub_judul,
            'link' => $request->link,
            'gambar' => $imageName,
        ]);

        toast('Berhasil menambahkan data!','success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $carousels = Carousel::findOrFail($id);

        $carousels->judul = $request->judul;
        $carousels->sub_judul = $request->sub_judul;
        $carousels->link = $request->link;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($carousels->gambar && Storage::disk('public')->exists($carousels->gambar)) {
                Storage::disk('public')->delete($carousels->gambar);
            }

            // Generate judul baru
            $originalName = $request->file('gambar')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imagePath = 'carousel/' . $fileName;
            $storagePath = storage_path('app/public/' . $imagePath);

            // Pastikan folder ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Konversi dan simpan gambar
            $imageFromRequest = $request->file('gambar')->getRealPath();

            Image::read($imageFromRequest)
                ->toWebp()
                ->save($storagePath);

            $carousels->gambar = $imagePath;
        }

        $carousels->save();
        toast('Berhasil mengubah data!','success');
        return redirect()->back();
    }


    public function destroy($id)
    {
        $carousels = Carousel::findOrFail($id);

        if ($carousels->gambar && Storage::disk('public')->exists($carousels->gambar)) {
            Storage::disk('public')->delete($carousels->gambar);
        }

        $carousels->delete();

        toast('Berhasil menghapus data!','success');
        return redirect()->back();
    }
}
