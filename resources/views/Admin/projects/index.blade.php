<x-layouts.app :title="__('Projects')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Porjects') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola daftar project dan fitur sistem perusahaan di sini.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="flex justify-between items-center mb-4">
            <flux:button href="{{ route('projects.create') }}" variant="primary" color="blue">
                <i class="bi bi-plus"></i> Tambah
            </flux:button>
        </div>

        {{-- SweetAlert --}}
        @include('sweetalert::alert')

        <div class="overflow-x-auto table-responsive">
            <table id="projectsTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b text-left w-12">#</th>
                        <th class="px-4 py-3 border-b text-left">Thumbnail</th>
                        <th class="px-4 py-3 border-b text-left">Nama Projek</th>
                        <th class="px-4 py-3 border-b text-center">Client</th>
                        <th class="px-4 py-3 border-b text-left">Kategori Projek</th>
                        <th class="px-4 py-3 border-b text-left">Deskripsi</th>
                        <th class="px-4 py-3 border-b text-left">Waktu</th>
                        <th class="px-4 py-3 border-b text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border-b text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                @if($project->thumbnail)
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                        alt="{{ $project->nama_projek }}"
                                        class="w-16 h-12 object-contain rounded border">
                                @else
                                    <span class="text-gray-400">Tidak ada thumbnail</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border-b text-gray-600">{{ $project->nama_projek }}</td>
                            <td class="px-4 py-2 border-b text-gray-600">{{ $project->clients->nama }}</td>
                            <td class="px-4 py-2 border-b text-gray-600">{{ $project->kategori_projek }}</td>
                            <td class="px-4 py-2 border-b text-center">{!! Str::limit(strip_tags($project->deskripsi), 60, '...') !!}</td>
                            <td class="px-4 py-2 border-b text-gray-600">{{ $project->tahun }}</td>
                            <td class="px-4 py-2 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <flux:button href="{{ route('projects.edit', $project->id) }}" variant="primary" color="amber">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </flux:button>

                                    <flux:modal.trigger name="delete-projects-{{ $project->id }}">
                                        <flux:button variant="danger"><i class="bi bi-trash"></i> Delete</flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </section>
    @include('Admin.projects.delete', ['projects' => $projects])
    @if($projects->count() > 0)
        <script>
        $(document).ready(function () {
            $('#projectsTable').DataTable({
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
