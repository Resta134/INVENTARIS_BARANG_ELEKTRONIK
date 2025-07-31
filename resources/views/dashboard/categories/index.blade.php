<x-layouts.app title="Data Kategori">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Daftar Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Data Category</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <form action="{{ route('kategori.index') }}" method="get">
            @csrf
            <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Categories" />
        </form>
        <flux:button icon="plus">
            <flux:link href="{{ route('kategori.create') }}" variant="subtle">Add New Category</flux:link>
        </flux:button>
    </div>

    @if(session('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session('successMessage') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">ID</th>
                    <th class="px-5 py-3 border-b bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Gambar</th>
                    <th class="px-5 py-3 border-b bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Nama Kategori</th>
                    <th class="px-5 py-3 border-b bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Deskripsi</th>
                    <th class="px-5 py-3 border-b bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $kategori)
                <tr>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $key + 1 }}</td>

                    <td class="px-5 py-3 border-b bg-white text-sm">
                        @if($kategori->image)
                            <img src="{{ Storage::url($kategori->image) }}" alt="{{ $kategori->nama_kategori }}" class="w-14 h-14 object-cover rounded border" />
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                        @endif
                    </td>

                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $kategori->nama_kategori }}</td>

                    <td class="px-5 py-3 border-b bg-white text-sm">
                        {{ $kategori->description ?? '-' }}
                    </td>

                    <td class="px-5 py-3 border-b bg-white text-sm">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down">Aksi</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="pencil" href="{{ route('kategori.edit', $kategori->id) }}">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus?')) document.getElementById('delete-form-{{ $kategori->id }}').submit();">Delete</flux:menu.item>
                                <form id="delete-form-{{ $kategori->id }}" action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
</x-layouts.app>
