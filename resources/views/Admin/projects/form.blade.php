<x-layouts.app :title="$projects ? 'Edit Projects' : 'Tambah Projects'">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">
                {{ $projects ? 'Edit Projects' : 'Tambah Projects' }}
            </flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ $projects ? 'Ubah detail projects di sini.' : 'Isi detail projects baru di sini.' }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        @if ($errors->any())
            <div class="alert alert-danger error-message" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('sweetalert::alert')

        <form action="{{ $projects ? route('projects.update', $projects->id) : route('projects.store') }}"
                method="POST" enctype="multipart/form-data">
            @csrf
            @if($projects)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    {{-- Nama Projek --}}
                    <div>
                        <label class="block mb-1 font-medium">Nama Projek</label>
                        <input type="text" name="nama_projek"
                            value="{{ old('nama_projek', $projects->nama_projek ?? '') }}"
                            class="w-full border rounded px-3 py-2" required>
                        @error('nama_projek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Client --}}
                    <div>
                        <label class="block mb-1 font-medium">Client</label>
                        <select name="clients_id" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ old('clients_id', $projects->clients_id ?? '') == $client->id ? 'selected' : '' }}>
                                    {{ $client->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('clients_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori Projek --}}
                    <div>
                        <label class="block mb-1 font-medium">Kategori Projek</label>
                        <select name="kategori_projek" class="w-full border rounded px-3 py-2" required>
                            <option value="">Pilih Kategori Projek</option>
                            @foreach(['Irigasi', 'Bendungan', 'Klimatologi', 'Geothermal', 'Geoteknik'] as $kategori)
                                <option value="{{ $kategori }}"
                                    {{ old('kategori_projek', $projects->kategori_projek ?? '') == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_projek')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block mb-1 font-medium">Lokasi</label>
                        <input placeholder="Kadirojo I, Purwomartani, Kec. Kalasan, Kabupaten Sleman" type="text" name="lokasi"
                            value="{{ old('lokasi', $projects->lokasi ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('lokasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div>
                        <label class="block mb-1 font-medium">URL</label>
                        <input placeholder="https://www.example.com/" type="text" name="url"
                            value="{{ old('url', $projects->url ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tahun --}}
                    <div>
                        <label class="block mb-1 font-medium">Tahun</label>
                        <input placeholder="1999" type="number" name="tahun"
                            value="{{ old('tahun', $projects->tahun ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('tahun')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Gambar Projek (Slide)</label>
                        <input type="file" name="image[]" accept="image/png, image/jpeg" multiple
                            class="w-full border rounded px-3 py-2">
                        <small class="text-gray-500">* Bisa upload lebih dari satu gambar. Format: JPG/PNG, max 2MB per file</small>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        {{-- Preview jika sedang edit --}}
                        @if(isset($projects) && $projects->imageProjects->count())
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-3">
                                @foreach($projects->imageProjects as $img)
                                    <div class="relative">
                                        <img src="{{ asset('storage/'.$img->gambar) }}" alt="Slide"
                                            class="w-full h-32 object-cover rounded border">
                                        <flux:modal.trigger name="delete-img-{{ $img->id }}">
                                            <button type="button"
                                                class="absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white text-xs px-2 py-1 rounded-full shadow-md">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </flux:modal.trigger>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    {{-- Deskripsi --}}
                    <div>
                        <label class="block mb-1 font-medium">Deskripsi</label>
                        <textarea name="deskripsi" id="content-editor"
                                class="ckeditor w-full border rounded px-3 py-2">{{ old('deskripsi', $projects->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- White Paper --}}
                    <div>
                        <label class="block mb-1 font-medium">URL White Paper</label>
                        <input type="text" placeholder="https://drive.google.com/file/d/xxxxxxxx" name="white_paper"
                            value="{{ old('white_paper', $projects->white_paper ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('white_paper')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div>
                        <label class="block mb-1 font-medium">Thumbnail</label>
                        <input type="file" name="thumbnail" accept="image/png, image/jpeg"
                            class="w-full border rounded px-3 py-2">
                        <small class="text-gray-500">* Format: JPG atau PNG, max 2MB</small>
                        @error('thumbnail')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        @if(isset($projects) && $projects->thumbnail)
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$projects->thumbnail) }}"
                                    alt="Preview" class="w-32 h-20 object-cover rounded border">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('projects.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ $projects ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </section>
    @include('Admin.projects.delete_image', ['projects' => $projects])
</x-layouts.app>
