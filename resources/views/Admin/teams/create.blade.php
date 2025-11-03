<flux:modal name="tambah-teams" class="md:w-[700px]">
    <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Teams</flux:heading>
            </div>

            {{-- Grid 2 Kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Kolom Kiri --}}
                <div class="space-y-4">
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

                    <flux:input
                        label="Posisi"
                        name="posisi"
                        placeholder="Posisi"
                        value="{{ old('posisi') }}"
                        required
                    />
                    @error('posisi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <flux:input
                        label="Facebook"
                        name="facebook"
                        placeholder="Facebook"
                        value="{{ old('facebook') }}"
                    />
                    @error('facebook')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <flux:input
                        label="Instagram"
                        name="instagram"
                        placeholder="Instagram"
                        value="{{ old('instagram') }}"
                    />
                    @error('instagram')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <flux:input
                        label="Linkedin"
                        name="linkedin"
                        placeholder="Linkedin"
                        value="{{ old('linkedin') }}"
                    />
                    @error('linkedin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kolom Kanan --}}
                <div class="space-y-4">
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

                    {{-- Select Level --}}
                    <flux:select
                        label="Level"
                        name="level"
                        placeholder="Pilih Level"
                        required
                        value="{{ old('level') }}"
                    >
                        <flux:select.option value="1">1</flux:select.option>
                        <flux:select.option value="2">2</flux:select.option>
                        <flux:select.option value="3">3</flux:select.option>
                        <flux:select.option value="4">4</flux:select.option>
                    </flux:select>
                    @error('level')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-2 pt-4 border-t">
                <flux:modal.close>
                    <flux:button variant="outline">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </div>
    </form>
</flux:modal>
