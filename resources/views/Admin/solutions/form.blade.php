<x-layouts.app :title="$solution ? 'Edit Solution' : 'Tambah Solution'">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">
                {{ $solution ? 'Edit Solution' : 'Tambah Solution' }}
            </flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ $solution ? 'Ubah detail solution di sini.' : 'Isi detail solution baru di sini.' }}
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

        <form action="{{ $solution ? route('solutions.update', $solution->id) : route('solutions.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if($solution)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Nama</label>
                        <input type="text" name="nama"
                            value="{{ old('nama', $solution->nama ?? '') }}"
                            class="w-full border rounded px-3 py-2" required>
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Description</label>
                        <input type="text" name="description"
                            value="{{ old('description', $solution->description ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Icon</label>
                        <input type="text" name="icon"
                            value="{{ old('icon', $solution->icon ?? '') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('icon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Content</label>
                        <textarea name="content" id="content-editor"
                                class="ckeditor w-full border rounded px-3 py-2">{{ old('content', $solution->content ?? '') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Image Content</label>
                        <input type="file" name="image_content" accept="image/png, image/jpeg"
                            class="w-full border rounded px-3 py-2">
                        <small class="text-gray-500">* Format: JPG atau PNG, max 2MB</small>
                        @error('image_content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @if(isset($solution->image_content))
                            <div class="mt-2">
                                <img src="{{ asset('storage/'.$solution->image_content) }}" alt="Preview"
                                    class="w-32 h-20 object-cover rounded border">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-2 mt-4">
                <a href="{{ route('solutions.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    {{ $solution ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </section>
</x-layouts.app>
