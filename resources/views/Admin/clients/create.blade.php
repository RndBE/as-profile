<flux:modal name="tambah-clients" class="md:w-96">
    <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Clients</flux:heading>
            </div>

            {{-- Input Nama --}}
            <flux:input
                label="Nama"
                name="nama"
                placeholder="Nama Client"
                value="{{ old('nama') }}"
                required
            />
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- Input Logo --}}
            <div>
                <flux:input
                    type="file"
                    name="logo"
                    label="Logo"
                    accept="image/*"
                />
                @error('logo')
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
