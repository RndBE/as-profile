<flux:modal name="tambah-contacts" class="md:w-[700px]">
    <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Tambah Contacts</flux:heading>
            </div>

            <flux:input
                label="Alamat"
                name="alamat"
                placeholder="Alamat"
                value="{{ old('alamat') }}"
                required
            />
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <flux:input
                label="Email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
            />
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <flux:input
                label="Phone"
                name="phone"
                placeholder="Phone"
                value="{{ old('phone') }}"
            />
            @error('phone')
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
