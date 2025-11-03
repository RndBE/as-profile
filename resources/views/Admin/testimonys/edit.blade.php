@foreach ($testimonys as $testimony)
    <flux:modal name="edit-testimonys-{{ $testimony->id }}" class="md:w-96">
        <form action="{{ route('testimonys.update', $testimony->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Testimonys</flux:heading>
                </div>

                {{-- Input Nama --}}
                <flux:input
                    label="Nama"
                    name="nama"
                    placeholder="Nama"
                    value="{{ old('nama', $testimony->nama) }}"
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
                    @if($testimony->foto)
                        <img src="{{ asset('storage/' . $testimony->foto) }}"
                            alt="{{ $testimony->nama }}"
                            class="w-24 h-20 object-contain border rounded mt-2">
                    @endif

                    @error('foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <flux:input
                    label="Pekerjaan"
                    name="pekerjaan"
                    placeholder="Pekerjaan"
                    value="{{ old('pekerjaan', $testimony->pekerjaan) }}"
                    required
                />
                @error('pekerjaan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:textarea
                    label="Testimoni"
                    name="testimoni"
                    placeholder="Masukkan testimoni"
                    required
                >
                    {{ old('testimoni', $testimony->testimoni) }}
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
@endforeach
