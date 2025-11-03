<flux:modal name="tambah-testimonys" class="md:w-96">
    <form action="{{ route('testimonys.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Testimonys</flux:heading>
            </div>

            {{-- Input Nama --}}
            <flux:input
                label="Nama"
                name="nama"
                placeholder="Nama"
                value="{{ old('nama') }}"
                required
            />
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- Input Foto --}}
            <div>
                <flux:input
                    type="file"
                    name="foto"
                    label="Foto"
                    accept="image/*"
                />
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <flux:input
                label="Pekerjaan"
                name="pekerjaan"
                placeholder="Pekerjaan"
                value="{{ old('pekerjaan') }}"
                required
            />
            @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <flux:textarea
                label="Testimoni"
                name="testimoni"
                placeholder="Testimoni"
                required
            >
                {{ old('testimoni') }}
            </flux:textarea>
            @error('testimoni')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror


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
