<?php

namespace App\Http\Controllers;

use App\Models\BarangElektronik;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarangElektronikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $data = BarangElektronik::when($q, function ($query) use ($q) {
            $query->where('nama_barang', 'like', "%$q%")
                ->orWhere('kode_barang', 'like', "%$q%");
        })->paginate(10);

        return view('dashboard.barang.index', compact('data', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.barang.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255|unique:barang_elektronik,nama_barang',
            'kode_barang' => 'required|string|max:100|unique:barang_elektronik,kode_barang',
            'kategori' => 'required|string|max:100',
            'merk' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'tahun_pembelian' => 'required|integer|min:2000|max:' . date('Y'),
            'kondisi' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        BarangElektronik::create($request->all());

        return redirect()->route('barang.index')->with('successMessage', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangElektronik $barangElektronik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = BarangElektronik::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.barang.edit', compact('barang', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, BarangElektronik $barangElektronik)
    // {
    //     $request->validate([
    //         'nama_barang' => [
    //             'required', 'string', 'max:255', 
    //             Rule::unique('barang_elektronik', 
    //             'nama_barang')->ignore($barangElektronik->id),
    //         ],
    //         'kode_barang' => [
    //             'required', 'string', 'max:100', 
    //             Rule::unique('barang_elektronik', 
    //             'kode_barang')->ignore($barangElektronik->id),
    //         ],
    //         'kategori' => 'required|string|max:100',
    //         'merk' => 'nullable|string|max:100',
    //         'model' => 'nullable|string|max:100',
    //         'tahun_pembelian' => 'required|integer|min:2000|max:' . date('Y'),
    //         'kondisi' => 'required|string|max:50',
    //         'jumlah' => 'required|integer|min:1',
    //         'lokasi_penyimpanan' => 'required|string|max:255',
    //         'keterangan' => 'nullable|string',
    //     ]);

    //     $barangElektronik->update($request->all());

    //     return redirect()->route('barang.index')->with('successMessage', 'Barang berhasil diperbarui.');
    // }

    public function update(Request $request, string $id)
    {
        $barang = BarangElektronik::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255|unique:barang_elektronik,nama_barang,' . $barang->id,
            'kode_barang' => 'required|string|max:100|unique:barang_elektronik,kode_barang,' . $barang->id,
            'kategori' => 'required|string|max:255',
            'merk' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'tahun_pembelian' => 'required|integer|min:2000|max:' . date('Y'),
            'kondisi' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('errorMessage', 'Validasi Error, silakan periksa kembali isian Anda.');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun_pembelian' => $request->tahun_pembelian,
            'kondisi' => $request->kondisi,
            'jumlah' => $request->jumlah,
            'lokasi_penyimpanan' => $request->lokasi_penyimpanan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang.index')
            ->with('successMessage', 'Data barang berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = BarangElektronik::findOrFail($id);

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('successMessage', 'Data barang berhasil dihapus.');
    }
}
