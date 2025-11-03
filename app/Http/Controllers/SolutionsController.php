<?php

namespace App\Http\Controllers;

use App\Models\Solutions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Laravel\Facades\Image;

class SolutionsController extends Controller
{
    public function index()
    {
        $data = [
            'solutions' => Solutions::orderBy('nama', 'asc')->get(),
        ];

        return view('Admin.solutions.index', $data);
    }

    public function show($slug)
    {
        $solution = Solutions::where('slug', $slug)->firstOrFail();
        $solutions = Solutions::orderBy('nama')->get();

        return view('User.solutions.show', compact('solution', 'solutions'));
    }

    public function create()
    {
        $solution = null;
        return view('Admin.solutions.form', compact('solution'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image_content' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Buat slug unik
        $slug = Str::slug($request->nama);
        $count = Solutions::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        // Buat instance baru
        $solution = new Solutions();
        $solution->nama = $request->nama;
        $solution->description = $request->description;
        $solution->content = $request->content;
        $solution->icon = $request->icon;
        $solution->slug = $slug;

        // Simpan gambar jika ada
        if ($request->hasFile('image_content')) {
            $originalName = $request->file('image_content')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $imageName = 'solutions/' . $fileName;
            $storagePath = storage_path('app/public/' . $imageName);

            // Buat direktori kalau belum ada
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            // Konversi ke .webp
            $imageFromRequest = $request->file('image_content')->getRealPath();
            Image::read($imageFromRequest)
                ->toWebp(90)
                ->save($storagePath);

            // Simpan nama file ke database
            $solution->image_content = $imageName;
        }

        $solution->save();

        Alert::toast('Berhasil menambahkan data!', 'success');
        return redirect()->route('solutions.index');
    }

    public function edit($id)
    {
        $solution = Solutions::findOrFail($id);
        return view('Admin.solutions.form', compact('solution'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image_content' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $solution = Solutions::findOrFail($id);

        // Tentukan slug baru hanya jika nama berubah
        if ($request->nama !== $solution->nama) {
            $slug = Str::slug($request->nama);

            // Pastikan slug unik
            $count = Solutions::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $solution->slug = $slug;
        }

        // Update data teks
        $solution->fill([
            'nama' => $request->nama,
            'description' => $request->description,
            'content' => $request->content,
            'icon' => $request->icon,
        ]);

        // Jika ada file gambar baru
        if ($request->hasFile('image_content')) {
            // Hapus gambar lama jika ada
            if ($solution->image_content && Storage::disk('public')->exists($solution->image_content)) {
                Storage::disk('public')->delete($solution->image_content);
            }

            // Proses dan simpan gambar baru dalam format WebP
            $originalName = pathinfo($request->file('image_content')->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = time() . '_' . Str::slug($originalName) . '.webp';
            $imagePath = 'solutions/' . $fileName;

            $storagePath = storage_path('app/public/' . $imagePath);
            if (!file_exists(dirname($storagePath))) {
                mkdir(dirname($storagePath), 0755, true);
            }

            Image::read($request->file('image_content')->getRealPath())
                ->toWebp(90)
                ->save($storagePath);

            $solution->image_content = $imagePath;
        }

        $solution->save();

        Alert::toast('Data berhasil diperbarui!', 'success');
        return redirect()->route('solutions.index');
    }



    public function destroy($id)
    {
        $solution = Solutions::findOrFail($id);

        // Hapus gambar jika ada
        if ($solution->image_content && Storage::disk('public')->exists($solution->image_content)) {
            Storage::disk('public')->delete($solution->image_content);
        }

        $solution->delete();

        Alert::toast('Data berhasil dihapus!', 'success');
        return redirect()->route('solutions.index');
    }
}
