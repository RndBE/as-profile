<x-layouts.app :title="__('Contacts')">
    <section class="w-full">
        <div class="relative mb-6 w-full">
            <flux:heading size="xl" level="1">{{ __('Contacts') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Kelola daftar contact dan fitur sistem perusahaan di sini.') }}
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <div class="flex justify-between items-center mb-4">
            <flux:modal.trigger name="tambah-contacts">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </flux:modal.trigger>
        </div>

        {{-- SweetAlert --}}
        @include('sweetalert::alert')

        <div class="overflow-x-auto table-responsive">
            <table id="contactsTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 border-b text-left w-12">#</th>
                        <th class="px-4 py-3 border-b text-left">Alamat</th>
                        <th class="px-4 py-3 border-b text-left">Email</th>
                        <th class="px-4 py-3 border-b text-left">Phone</th>
                        <th class="px-4 py-3 border-b text-left">Instagram</th>
                        <th class="px-4 py-3 border-b text-left">Linkedin</th>
                        <th class="px-4 py-3 border-b text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 border-b text-gray-600 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $contact->alamat }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $contact->email }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $contact->phone }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $contact->instagram }}
                            </td>
                            <td class="px-4 py-2 border-b font-medium text-gray-800">
                                {{ $contact->linkedin }}
                            </td>
                            <td class="px-4 py-2 border-b text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <flux:modal.trigger name="edit-contacts-{{ $contact->id }}">
                                        <flux:button variant="primary" color="amber">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </flux:button>
                                    </flux:modal.trigger>

                                    <flux:modal.trigger name="delete-contacts-{{ $contact->id }}">
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
    @include('Admin.contacts.create')
    @include('Admin.contacts.edit', ['contacts' => $contacts])
    @include('Admin.contacts.delete', ['contacts' => $contacts])
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
    @if($contacts->count() > 0)
        <script>
        $(document).ready(function () {
            $('#contactsTable').DataTable({
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
