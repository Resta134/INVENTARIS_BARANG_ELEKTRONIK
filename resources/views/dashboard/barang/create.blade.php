<x-layouts.app title="Barang Elektronik">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Barang</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Barang Elektronik</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <flux:input label="Nama Barang" name="nama_barang" required />
        
        <flux:input label="Kode Barang" name="kode_barang" required />
        
        <flux:select label="Kategori" name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $kategori)
                <option value="{{ $kategori->nama_kategori }}">
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </flux:select>

        <flux:input label="Merk" name="merk" />
        <flux:input label="Model" name="model" />
        <flux:input label="Tahun Pembelian" name="tahun_pembelian" type="number" min="2000" max="{{ date('Y') }}" required />
        
        <flux:select label="Kondisi" name="kondisi" required>
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik">Baik</option>
            <option value="Rusak Ringan">Rusak Ringan</option>
            <option value="Rusak Berat">Rusak Berat</option>
        </flux:select>

        <flux:input type="number" label="Jumlah" name="jumlah" class="mb-4" value="{{ old('jumlah') }}" />

        <flux:input label="Lokasi Penyimpanan" name="lokasi_penyimpanan" class="mb-4" value="{{ old('lokasi_penyimpanan') }}" />

        <flux:textarea label="Keterangan (Opsional)" name="keterangan" class="mb-4">{{ old('keterangan') }}</flux:textarea>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Simpan</flux:button>
            <flux:link href="{{ route('barang.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>
