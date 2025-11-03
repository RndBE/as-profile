<x-layouts.app :title="__('About Us')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('About Us') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola informasi About Us dan fitur perusahaan.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        @include('sweetalert::alert')

        <div class="container space-y-8">

            {{-- CARD UTAMA ABOUT US --}}
            <div class="bg-white shadow-md rounded-lg p-5 border border-gray-100">
                <flux:heading size="lg" class="mb-4">Informasi Umum</flux:heading>

                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <flux:input
                        label="Judul"
                        placeholder="Judul"
                        type="text"
                        name="judul"
                        value="{{ old('judul', $about->judul ?? '') }}"
                    />
                    @error('judul')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <flux:textarea
                        label="Deskripsi"
                        placeholder="Deskripsi"
                        name="deskripsi"
                    >{{ old('deskripsi', $about->deskripsi ?? '') }}</flux:textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <flux:input
                        label="Video URL"
                        placeholder="Contoh: https://youtube.com/..."
                        type="text"
                        name="video_url"
                        value="{{ old('video_url', $about->video_url ?? '') }}"
                    />
                    @error('video_url')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <div class="space-y-2">
                        <flux:input
                            label="Thumbnail"
                            type="file"
                            name="gambar"
                        />
                        @error('gambar')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror

                        @if(!empty($about->gambar))
                            <img src="{{ asset('storage/' . $about->gambar) }}"
                                 alt="Thumbnail"
                                 class="w-48 rounded-lg shadow-sm border border-gray-200">
                        @endif
                    </div>

                    <div class="pt-2">
                        <flux:button variant="primary" type="submit">
                            <i class="bi bi-save me-1"></i> Simpan
                        </flux:button>
                    </div>
                </form>
            </div>

            {{-- CARD FITUR ABOUT US --}}
            <div class="bg-white shadow-md rounded-lg p-5 border border-gray-100">
                <flux:heading size="lg" class="mb-4">Fitur About Us</flux:heading>

                <form action="{{ route('about.feature.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <flux:input type="hidden" name="about_id" value="{{ $about->id ?? '' }}" />

                    <flux:input label="Icon (contoh: bi bi-star)" name="icon" placeholder="Masukkan class icon" />
                    <flux:input label="Judul Fitur" name="judul" placeholder="Judul fitur" />
                    <flux:textarea label="Deskripsi Fitur" name="deskripsi" placeholder="Deskripsi singkat fitur"></flux:textarea>
                    <flux:input label="Urutan" type="number" name="urutan" placeholder="1, 2, 3..." />

                    <div class="pt-2">
                        <flux:button variant="primary" type="submit">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Fitur
                        </flux:button>
                    </div>
                </form>

                <flux:separator variant="subtle" class="my-4" />

                <div class="space-y-2">
                    @forelse($about->features ?? [] as $feature)
                        <div class="p-3 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition rounded-md">
                            <div class="flex items-center gap-3">
                                <i class="{{ $feature->icon }} text-primary text-lg"></i>
                                <div>
                                    <p class="font-medium">{{ $feature->judul }}</p>
                                    <p class="text-sm text-gray-500">{{ $feature->deskripsi }}</p>
                                </div>
                            </div>
                            <flux:modal.trigger name="delete-feature-{{ $feature->id }}">
                                <flux:button variant="danger"><i class="bi bi-trash"></i> Delete</flux:button>
                            </flux:modal.trigger>
                        </div>
                        @include('Admin.about.delete', ['feature' => $feature])
                    @empty
                        <p class="text-gray-500 text-sm italic">Belum ada fitur ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
