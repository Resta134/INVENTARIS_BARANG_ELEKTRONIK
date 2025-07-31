<x-layouts.app title="Edit Barang Elektronik">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Barang</flux:heading>
        <flux:subheading size="lg" class="mb-6">Ubah data barang elektronik</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('barang.update', $barang) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:input label="Nama Barang" name="nama_barang" class="mb-4" value="{{ old('nama_barang', $barang->nama_barang) }}" />

        <flux:input label="Kode Barang" name="kode_barang" class="mb-4" value="{{ old('kode_barang', $barang->kode_barang) }}" />

        <flux:select label="Kategori" name="kategori" class="mb-4">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $kategori)
                <option value="{{ $kategori->nama_kategori }}"
                    {{ old('kategori', $barang->kategori) == $kategori->nama_kategori ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </flux:select>

        <flux:input label="Merk" name="merk" class="mb-4" value="{{ old('merk', $barang->merk) }}" />

        <flux:input label="Model" name="model" class="mb-4" value="{{ old('model', $barang->model) }}" />

        <flux:input label="Tahun Pembelian" name="tahun_pembelian" class="mb-4" value="{{ old('tahun_pembelian', $barang->tahun_pembelian) }}" />

        <flux:select label="Kondisi" name="kondisi" class="mb-4">
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik" {{ old('kondisi', $barang->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ old('kondisi', $barang->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ old('kondisi', $barang->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
        </flux:select>

        <flux:input type="number" label="Jumlah" name="jumlah" class="mb-4" value="{{ old('jumlah', $barang->jumlah) }}" />

        <flux:input label="Lokasi Penyimpanan" name="lokasi_penyimpanan" class="mb-4" value="{{ old('lokasi_penyimpanan', $barang->lokasi_penyimpanan) }}" />

        <flux:textarea label="Keterangan" name="keterangan" class="mb-4">{{ old('keterangan', $barang->keterangan) }}</flux:textarea>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('barang.index') }}" variant="ghost" class="ml-3">Batal</flux:link>
        </div>
    </form>
</x-layouts.app>
