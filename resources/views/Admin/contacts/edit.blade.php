@foreach ($contacts as $contact)
    <flux:modal name="edit-contacts-{{ $contact->id }}" class="md:w-[700px]">
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Contacts</flux:heading>
                </div>
                {{-- Input Alamat --}}
                <flux:input
                    label="Alamat"
                    name="alamat"
                    placeholder="Alamat"
                    value="{{ old('alamat', $contact->alamat) }}"
                    required
                />
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:input
                    label="Email"
                    name="email"
                    placeholder="Email"
                    value="{{ old('email', $contact->email) }}"
                    required
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:input
                    label="Phone"
                    name="phone"
                    placeholder="Phone"
                    value="{{ old('phone', $contact->phone) }}"
                />
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:input
                    label="Instagram"
                    name="instagram"
                    placeholder="Instagram"
                    value="{{ old('instagram', $contact->instagram) }}"
                />
                @error('instagram')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:input
                    label="Linkedin"
                    name="linkedin"
                    placeholder="Linkedin"
                    value="{{ old('linkedin', $contact->linkedin) }}"
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
@endforeach
