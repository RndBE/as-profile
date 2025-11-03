<flux:modal name="tambah-carousels" class="md:w-96">
    <form action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Carousel</flux:heading>
            </div>

            {{-- Input Judul --}}
            <flux:input
                label="Judul"
                name="judul"
                placeholder="Judul"
                value="{{ old('judul') }}"
                required
            />
            @error('judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <flux:textarea
                label="Sub Judul"
                name="sub_judul"
                placeholder="Sub Judul"
                required
            >
                {{ old('sub_judul') }}
            </flux:textarea>
            @error('sub_judul')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <flux:input
                label="Link"
                name="link"
                placeholder="Link"
                value="{{ old('link') }}"
            />
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- Input gambar --}}
            <div>
                <flux:input
                    type="file"
                    name="gambar"
                    label="Gambar"
                    accept="image/*"
                />
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-2 pt-4">
                <flux:modal.close>
                    <flux:button variant="outline">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
