@foreach ($about->features ?? [] as $feature)
    <flux:modal name="delete-feature-{{ $feature->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus "{{ $feature->judul }}"?</flux:heading>
                <flux:text class="mt-2">
                    Anda akan menghapus fitur ini.<br>
                    <span>Tindakan ini tidak dapat dibatalkan.</span>
                </flux:text>
            </div>

            <div class="flex justify-end gap-2">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>

                <form action="{{ route('about.feature.destroy', $feature->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <flux:button type="submit" variant="danger">Hapus</flux:button>
                </form>
            </div>
        </div>
    </flux:modal>
@endforeach
