@foreach ($carousels as $carousel)
    <flux:modal name="edit-carousels-{{ $carousel->id }}" class="md:w-96">
        <form action="{{ route('carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Client</flux:heading>
                </div>

                {{-- Input Judul --}}
                <flux:input
                    label="Judul"
                    name="judul"
                    placeholder="Judul"
                    value="{{ old('judul', $carousel->judul) }}"
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
                    {{ old('sub_judul', $carousel->sub_judul) }}
                </flux:textarea>
                @error('sub_judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <flux:input
                    label="Link"
                    name="link"
                    placeholder="Link"
                    value="{{ old('link', $carousel->link) }}"
                    required
                />
                @error('link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- Input Gambar --}}
                <div>
                    <flux:input
                        type="file"
                        name="gambar"
                        label="Gambar"
                        accept="image/*"
                    />

                    @if($carousel->gambar)
                        <img src="{{ asset('storage/' . $carousel->gambar) }}"
                            alt="{{ $carousel->nama }}"
                            class="w-24 h-20 object-contain border rounded mt-2">
                    @endif

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
@endforeach
