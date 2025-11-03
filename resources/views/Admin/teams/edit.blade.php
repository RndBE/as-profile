@foreach ($teams as $team)
    <flux:modal name="edit-teams-{{ $team->id }}" class="md:w-[700px]">
        <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Teams</flux:heading>
                </div>

                {{-- Grid 2 Kolom --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-4">
                        {{-- Input Nama --}}
                        <flux:input
                            label="Nama"
                            name="nama"
                            placeholder="Nama"
                            value="{{ old('nama', $team->nama) }}"
                            required
                        />
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <flux:input
                            label="Posisi"
                            name="posisi"
                            placeholder="Posisi"
                            value="{{ old('posisi', $team->posisi) }}"
                            required
                        />
                        @error('posisi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <flux:input
                            label="Facebook"
                            name="facebook"
                            placeholder="Facebook"
                            value="{{ old('facebook', $team->facebook) }}"
                        />
                        @error('facebook')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <flux:input
                            label="Instagram"
                            name="instagram"
                            placeholder="Instagram"
                            value="{{ old('instagram', $team->instagram) }}"
                        />
                        @error('instagram')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <flux:input
                            label="Linkedin"
                            name="linkedin"
                            placeholder="Linkedin"
                            value="{{ old('linkedin', $team->linkedin) }}"
                        />
                        @error('linkedin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-4">
                        {{-- Input Foto --}}
                        <div>
                            <flux:input
                                type="file"
                                name="foto"
                                label="Foto"
                                accept="image/*"
                            />
                            @if($team->foto)
                                <img src="{{ asset('storage/' . $team->foto) }}"
                                    alt="{{ $team->nama }}"
                                    class="w-24 h-20 object-contain border rounded mt-2">
                            @endif

                            @error('foto')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <flux:select
                            label="Level"
                            name="level"
                            required
                        >
                            <flux:select.option value="1" :selected="$team->level == 1">1</flux:select.option>
                            <flux:select.option value="2" :selected="$team->level == 2">2</flux:select.option>
                            <flux:select.option value="3" :selected="$team->level == 3">3</flux:select.option>
                            <flux:select.option value="4" :selected="$team->level == 4">4</flux:select.option>
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
@endforeach
