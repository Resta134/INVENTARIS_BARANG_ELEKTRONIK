<x-layouts.app title="Barang">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Barang Elektronik</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Data Barang Elektronik</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('barang.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Barang" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('barang.create') }}" variant="subtle">Add New Barang</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
    <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
        {{ session()->get('successMessage') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Merk</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Model</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Tahun</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Kondisi</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Jumlah</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Lokasi</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                    <th class="px-5 py-3 border-b-2 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $barang)
                <tr>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $key + 1 }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->nama_barang }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->kode_barang }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->kategori }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->merk }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->model }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->tahun_pembelian }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->kondisi }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->jumlah }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->lokasi_penyimpanan }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">{{ $barang->keterangan }}</td>
                    <td class="px-5 py-3 border-b bg-white text-sm">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down">Aksi</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="pencil" href="{{ route('barang.edit', $barang->id) }}">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) document.getElementById('delete-form-{{ $barang->id }}').submit();">Hapus</flux:menu.item>
                                <form id="delete-form-{{ $barang->id }}" action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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
        {{ $data->links() }}
    </div>
</x-layouts.app>
