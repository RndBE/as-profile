<x-layouts.app :title="__('Clients')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Clients') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola daftar clients dan fitur sistem perusahaan di sini.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="flex justify-between items-center mb-4">
            <flux:modal.trigger name="tambah-clients">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </flux:modal.trigger>
        </div>

        {{-- SweetAlert --}}
        @include('sweetalert::alert')

        <div class="overflow-x-auto table-responsive">
            <table id="clientsTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b text-left w-12">#</th>
                        <th class="px-4 py-3 border-b text-left">Nama</th>
                        <th class="px-4 py-3 border-b text-left">Logo</th>
                        <th class="px-4 py-3 border-b text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border-b text-gray-600 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $client->nama }}
                            </td>
                            <td class="px-4 py-2 border-b text-gray-600 text-center">
                                @if($client->logo)
                                    <img src="{{ asset('storage/' . $client->logo) }}"
                                        alt="{{ $client->nama }}"
                                        class="w-16 h-12 object-contain rounded border">
                                @else
                                    <span class="text-gray-400">Tidak ada logo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <flux:modal.trigger name="edit-clients-{{ $client->id }}">
                                        <flux:button variant="primary" color="amber">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </flux:button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="delete-clients-{{ $client->id }}">
                                        <flux:button variant="danger"><i class="bi bi-trash"></i> Delete</flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    @include('Admin.clients.create')
    @include('Admin.clients.edit', ['clients' => $clients])
    @include('Admin.clients.delete', ['clients' => $clients])
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
    @if($clients->count() > 0)
        <script>
        $(document).ready(function () {
            $('#clientsTable').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    emptyTable: "Belum ada data yang tersedia"
                }
            });
        });
        </script>
    @endif
</x-layouts.app>
