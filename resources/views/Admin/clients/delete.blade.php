@foreach ($clients as $client)
    <flux:modal name="delete-clients-{{ $client->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus {{ $client->nama }}?</flux:heading>
                <flux:text class="mt-2">
                    Anda akan menghapus client ini.<br>
                    Tindakan ini tidak dapat dibatalkan.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <flux:button type="submit" variant="danger">Hapus</flux:button>
                </form>
            </div>
        </div>
    </flux:modal>
@endforeach
