<x-layouts.app :title="__('Teams')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Teams') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola daftar teams dan fitur sistem perusahaan di sini.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="flex justify-between items-center mb-4">
            <flux:modal.trigger name="tambah-teams">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </flux:modal.trigger>
        </div>

        {{-- SweetAlert --}}
        @include('sweetalert::alert')

        <div class="overflow-x-auto table-responsive">
            <table id="teamsTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b text-left w-12">#</th>
                        <th class="px-4 py-3 border-b text-left">Nama</th>
                        <th class="px-4 py-3 border-b text-left">Foto</th>
                        <th class="px-4 py-3 border-b text-left">Posisi</th>
                        <th class="px-4 py-3 border-b text-left">Level</th>
                        <th class="px-4 py-3 border-b text-left">Facebook</th>
                        <th class="px-4 py-3 border-b text-left">Instagram</th>
                        <th class="px-4 py-3 border-b text-left">Linkedin</th>
                        <th class="px-4 py-3 border-b text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teams as $team)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border-b text-gray-600 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->nama }}
                            </td>
                            <td class="px-4 py-2 border-b text-gray-600 text-center">
                                @if($team->foto)
                                    <img src="{{ asset('storage/' . $team->foto) }}"
                                        alt="{{ $team->nama }}"
                                        class="w-16 h-12 object-contain rounded border">
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->posisi }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->level }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->facebook }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->instagram }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $team->linkedin }}
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <flux:modal.trigger name="edit-teams-{{ $team->id }}">
                                        <flux:button variant="primary" color="amber">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </flux:button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="delete-teams-{{ $team->id }}">
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
    @include('Admin.teams.create')
    @include('Admin.teams.edit', ['teams' => $teams])
    @include('Admin.teams.delete', ['teams' => $teams])
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
    @if($teams->count() > 0)
        <script>
        $(document).ready(function () {
            $('#teamsTable').DataTable({
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
