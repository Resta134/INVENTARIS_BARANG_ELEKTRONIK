<x-layouts.app :title="__('Edit Kategori')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Kategori</flux:heading>
        <flux:subheading size="lg" class="mb-6">Perbarui data kategori di bawah ini</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded bg-red-100 border border-red-400 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:input 
            label="Nama Kategori" 
            name="nama_kategori" 
            value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
            class="mb-3" 
        />

        <flux:textarea 
            label="Deskripsi" 
            name="description" 
            class="mb-3"
        >{{ old('description', $kategori->description) }}</flux:textarea>

        <flux:input 
            type="file" 
            label="Gambar Baru (Opsional)" 
            name="image" 
            class="mb-3" 
        />

        @if ($kategori->image)
            <div class="mb-3">
                <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                <img src="{{ Storage::url($kategori->image) }}" class="w-24 h-24 object-cover rounded border" />
            </div>
        @endif

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Simpan Perubahan</flux:button>
            <flux:link href="{{ route('kategori.index') }}" variant="ghost" class="ml-3">Batal</flux:link>
        </div>
    </form>
</x-layouts.app>
