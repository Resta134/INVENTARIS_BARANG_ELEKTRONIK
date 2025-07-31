<x-layouts.app title="Form Kategori">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Categories</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge>
    @endif

    @if($errors->any())
        <div class="mb-3 p-3 rounded bg-red-100 border border-red-400 text-red-800">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <flux:input
            label="Nama Kategori"
            name="nama_kategori"
            value="{{ old('nama_kategori') }}"
            class="mb-4"
        />

        <flux:textarea
            label="Deskripsi"
            name="description"
            class="mb-4"
        >{{ old('description') }}</flux:textarea>

        <flux:input
            type="file"
            label="Gambar"
            name="image"
            class="mb-4"
        />

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Simpan</flux:button>
            <flux:link href="{{ route('kategori.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>
