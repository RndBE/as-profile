<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Models\AboutFeatures;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AboutUsController extends Controller
{
    /**
     * Tampilkan halaman daftar / edit About Us
     */
    public function index()
    {
        $about = AboutUs::with('features')->first();
        return view('Admin.about.index', compact('about'));
    }

    /**
     * Simpan atau perbarui data About Us
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_url' => 'nullable|string|max:255',
        ]);

        $about = AboutUs::first() ?? new AboutUs();

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $originalName = $request->file('gambar')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $path = 'about/' . $fileName;
            $storagePath = storage_path('app/public/' . $path);

            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Konversi ke WebP
            $imageFromRequest = $request->file('gambar')->getRealPath();
            Image::read($imageFromRequest)->toWebp()->save($storagePath);

            // Hapus gambar lama jika ada
            if ($about->gambar && Storage::disk('public')->exists($about->gambar)) {
                Storage::disk('public')->delete($about->gambar);
            }

            $validated['gambar'] = $path;
        }

        $about->fill($validated);
        $about->save();

        toast('Data About Us berhasil disimpan!','success');
        return redirect()->back()->with('success', 'Data About Us berhasil disimpan.');
    }

    /**
     * Tambahkan fitur baru ke About Us
     */
    public function storeFeature(Request $request)
    {
        $validated = $request->validate([
            'about_id' => 'required|exists:about_us,id',
            'icon' => 'nullable|string|max:100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
        ]);

        AboutFeatures::create($validated);

        toast('Fitur berhasil ditambahkan!','success');
        return redirect()->back()->with('success', 'Fitur berhasil ditambahkan.');
    }

    public function updateFeature(Request $request, $id)
    {
        $feature = AboutFeatures::findOrFail($id);

        $validated = $request->validate([
            'icon' => 'nullable|string|max:100',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
        ]);

        $feature->update($validated);

        toast('Fitur berhasil diperbarui!', 'success');
        return redirect()->back()->with('success', 'Fitur berhasil diperbarui.');
    }


    /**
     * Hapus fitur dari About Us
     */
    public function destroyFeature($id)
    {
        $feature = AboutFeatures::findOrFail($id);
        $feature->delete();

        toast('Fitur berhasil dihapus!','success');
        return redirect()->back()->with('success', 'Fitur berhasil dihapus.');
    }
}
