<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Project;
use App\Models\Solutions;
use Illuminate\Support\Str;
use App\Models\ImageProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Laravel\Facades\Image;

class ProjectsController extends Controller
{
    public function index()
    {
        $data = [
            'projects' => Project::with('clients')->orderBy('tahun', 'asc')->get(),
        ];

        return view('Admin.projects.index', $data);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $projects = Project::orderBy('nama_projek')->get();

        return view('User.projects.show', compact('project', 'projects'));
    }

    public function create()
    {
        $projects = null;
        $clients = Clients::orderBy('nama', 'asc')->get();
        return view('Admin.projects.form', compact('projects','clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_projek' => 'required|string|max:255',
            'clients_id' => 'required|exists:clients,id',
            'kategori_projek' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'white_paper' => 'nullable|url|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_projects.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $originalName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $thumbnailName = 'projects/thumbnail/' . $fileName;
            $thumbnailPath = storage_path('app/public/' . $thumbnailName);

            // Pastikan folder ada
            if (!file_exists(dirname($thumbnailPath))) {
                mkdir(dirname($thumbnailPath), 0755, true);
            }

            // Konversi ke .webp
            Image::read($request->file('thumbnail')->getRealPath())
                ->toWebp(90)
                ->save($thumbnailPath);
        }

        // Buat slug unik
        $slug = Str::slug($request->nama_projek);
        $count = Project::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = "{$slug}-" . ($count + 1);
        }

        // Simpan data project utama
        $project = Project::create([
            'nama_projek' => $request->nama_projek,
            'clients_id' => $request->clients_id,
            'kategori_projek' => $request->kategori_projek,
            'lokasi' => $request->lokasi,
            'url' => $request->url,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'white_paper' => $request->white_paper,
            'thumbnail' => $thumbnailName,
            'slug' => $slug,
        ]);

        // Upload gambar slide jika ada
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                // Nama asli file
                $originalName = $image->getClientOriginalName();
                $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
                $imageName = 'projects/image/' . $fileName;
                $imagePath = storage_path('app/public/' . $imageName);

                // Pastikan folder ada
                if (!file_exists(dirname($imagePath))) {
                    mkdir(dirname($imagePath), 0755, true);
                }

                // Konversi ke WebP
                Image::read($image->getRealPath())
                    ->toWebp(90)
                    ->save($imagePath);

                // Simpan path ke database (relatif terhadap storage/public)
                ImageProject::create([
                    'projects_id' => $project->id,
                    'gambar' => $imageName,
                ]);
            }
        }

        Alert::toast('Project berhasil ditambahkan!', 'success');
        return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $projects = Project::findOrFail($id);
        $clients = Clients::orderBy('nama', 'asc')->get();
        return view('Admin.projects.form', compact('projects','clients'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'nama_projek' => 'required|string|max:255',
            'clients_id' => 'required|exists:clients,id',
            'kategori_projek' => 'required|string|max:100',
            'lokasi' => 'nullable|string|max:255',
            'url' => 'nullable|url|max:255',
            'tahun' => 'nullable|integer|min:1900|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'white_paper' => 'nullable|url|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // sesuai input name di Blade
        ]);

        // === HANDLE THUMBNAIL ===
        $thumbnailPath = $project->thumbnail;

        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            // Simpan thumbnail baru dalam format webp
            $originalName = $request->file('thumbnail')->getClientOriginalName();
            $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
            $relativePath = 'projects/thumbnail/' . $fileName;
            $absolutePath = storage_path('app/public/' . $relativePath);

            if (!file_exists(dirname($absolutePath))) {
                mkdir(dirname($absolutePath), 0755, true);
            }

            // Konversi ke webp
            Image::read($request->file('thumbnail')->getRealPath())
                ->toWebp(90)
                ->save($absolutePath);

            $thumbnailPath = $relativePath;
        }

        // === HANDLE SLUG ===
        if ($request->nama_projek !== $project->nama_projek) {
            $slug = Str::slug($request->nama_projek);
            $count = Project::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $project->slug = $slug;
        }

        // === UPDATE DATA UTAMA ===
        $project->update([
            'nama_projek' => $request->nama_projek,
            'clients_id' => $request->clients_id,
            'kategori_projek' => $request->kategori_projek,
            'lokasi' => $request->lokasi,
            'url' => $request->url,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'white_paper' => $request->white_paper,
            'thumbnail' => $thumbnailPath,
            'slug' => $project->slug,
        ]);

        // === HANDLE IMAGE SLIDE BARU ===
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $originalName = $image->getClientOriginalName();
                $fileName = time() . '_' . pathinfo($originalName, PATHINFO_FILENAME) . '.webp';
                $relativePath = 'projects/image/' . $fileName;
                $absolutePath = storage_path('app/public/' . $relativePath);

                if (!file_exists(dirname($absolutePath))) {
                    mkdir(dirname($absolutePath), 0755, true);
                }

                Image::read($image->getRealPath())
                    ->toWebp(90)
                    ->save($absolutePath);

                ImageProject::create([
                    'projects_id' => $project->id,
                    'gambar' => $relativePath,
                ]);
            }
        }

        Alert::toast('Project berhasil diperbarui!', 'success');
        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function deleteImage($id)
    {
        $image = ImageProject::findOrFail($id);

        // Hapus file fisik dari storage jika ada
        $filePath = storage_path('app/public/' . $image->gambar);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus record dari database
        $image->delete();

        Alert::toast('Gambar berhasil dihapus!', 'success');
        return back();
    }

    public function destroy($id)
    {
        $project = Project::with('imageProjects')->findOrFail($id);

        // === HAPUS THUMBNAIL ===
        if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        // === HAPUS GAMBAR SLIDE ===
        foreach ($project->imageProjects as $img) {
            if ($img->gambar && Storage::disk('public')->exists($img->gambar)) {
                Storage::disk('public')->delete($img->gambar);
            }
            $img->delete(); // hapus record di tabel image_projects
        }

        // === HAPUS DATA PROJECT ===
        $project->delete();

        Alert::toast('Project berhasil dihapus!', 'success');
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }

}
