<x-layouts.app :title="__('Solutions')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Solutions') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola daftar solusi dan fitur sistem perusahaan di sini.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="flex justify-between items-center mb-4">
            <flux:button href="{{ route('solutions.create') }}" variant="primary" color="blue">
                <i class="bi bi-plus"></i> Tambah
            </flux:button>
        </div>

        {{-- SweetAlert --}}
        @include('sweetalert::alert')

        <div class="overflow-x-auto table-responsive">
            <table id="solutionsTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b text-left w-12">#</th>
                        <th class="px-4 py-3 border-b text-left">Nama</th>
                        <th class="px-4 py-3 border-b text-left">Deskripsi</th>
                        <th class="px-4 py-3 border-b text-center">Icon</th>
                        <th class="px-4 py-3 border-b text-left">Content</th>
                        <th class="px-4 py-3 border-b text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($solutions as $solution)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border-b text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">{{ $solution->nama }}</td>
                            <td class="px-4 py-2 border-b text-gray-600">{{ $solution->description }}</td>
                            <td class="px-4 py-2 border-b text-center">{!! $solution->icon !!}</td>
                            <td class="px-4 py-2 border-b text-gray-600">
                                {!! Str::limit(strip_tags($solution->content), 60, '...') !!}
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <flux:button href="{{ route('solutions.edit', $solution->id) }}" variant="primary" color="amber">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </flux:button>

                                    <flux:modal.trigger name="delete-solutions-{{ $solution->id }}">
                                        <flux:button variant="danger"><i class="bi bi-trash"></i> Delete</flux:button>
                                    </flux:modal.trigger>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </section>
    @include('Admin.solutions.delete', ['solutions' => $solutions])
    @if($solutions->count() > 0)
        <script>
        $(document).ready(function () {
            $('#solutionsTable').DataTable({
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
