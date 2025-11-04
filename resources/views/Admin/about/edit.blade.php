@foreach ($about->features ?? [] as $feature)
    <flux:modal name="edit-feature-{{ $feature->id }}" class="min-w-[35rem]">
        <flux:heading>
            <h5 class="text-lg font-semibold">Edit Fitur</h5>
        </flux:heading>

        <form action="{{ route('about.feature.update', $feature->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <flux:input label="Icon" name="icon" value="{{ $feature->icon }}" />
            <flux:input label="Judul Fitur" name="judul" value="{{ $feature->judul }}" />
            <flux:textarea label="Deskripsi Fitur" name="deskripsi">{{ $feature->deskripsi }}</flux:textarea>
            <flux:input label="Urutan" type="number" name="urutan" value="{{ $feature->urutan }}" />
            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="primary">
                    <i class="bi bi-save me-1"></i> Update
                </flux:button>
            </div>
        </form>
    </flux:modal>
@endforeach
