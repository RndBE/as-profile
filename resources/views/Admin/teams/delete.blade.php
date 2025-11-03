@foreach ($teams as $team)
    <flux:modal name="delete-teams-{{ $team->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus {{ $team->nama }}?</flux:heading>
                <flux:text class="mt-2">
                    Anda akan menghapus team ini.<br>
                    Tindakan ini tidak dapat dibatalkan.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <flux:button type="submit" variant="danger">Hapus</flux:button>
                </form>
            </div>
        </div>
    </flux:modal>
@endforeach
