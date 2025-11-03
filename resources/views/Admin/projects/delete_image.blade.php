@if(isset($projects) && $projects->imageProjects->count())
    @foreach ($projects->imageProjects as $img)
        <flux:modal name="delete-img-{{ $img->id }}" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Hapus?</flux:heading>
                    <flux:text class="mt-2">
                        Anda akan menghapus gambar ini.<br>
                        Tindakan ini tidak dapat dibatalkan.
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Batal</flux:button>
                    </flux:modal.close>
                    <form action="{{ route('projects.image.delete', $img->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <flux:button type="submit" variant="danger">Hapus</flux:button>
                    </form>
                </div>
            </div>
        </flux:modal>
    @endforeach
@endif
