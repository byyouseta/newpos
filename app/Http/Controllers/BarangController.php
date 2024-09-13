<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Barang');
        session()->forget('cucu');
        set_time_limit(0);

        $data = Barang::where('status', TRUE)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('master.barang', compact('data'));
    }

    public function edit($id)
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Barang');
        session()->put('cucu', 'Edit Barang');

        $data = Barang::find($id);

        return view('master.editbarang', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'nama_barang' => 'required|regex:/^[\pL\s\-\d]+$/u',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'min_stok' => 'required|numeric'
        ], [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong.',
            'kode_barang.unique' => 'Kode Barang sudah digunakan.',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
            'nama_barang.regex' => 'Nama Barang hanya diperbolehkan Huruf dan Angka.',
            'harga_beli.required' => 'Harga Beli tidak boleh kosong.',
            'harga_jual.required' => 'Harga Jual tidak boleh kosong.',
            'stok.required' => 'Stok tidak boleh kosong.',
            'harga_beli.numeric' => 'Harga Beli harus dalam format angka.',
            'harga_jual.numeric' => 'Harga Jual harus dalam format angka.',
            'stok.numeric' => 'Stok harus dalam format angka.',
            'min_stok.numeric' => 'Stok harus dalam format angka.',
        ]);

        $simpan = new Barang();
        $simpan->kode_barang = $request->kode_barang;
        $simpan->nama_barang = $request->nama_barang;
        $simpan->barcode = $request->barcode;
        $simpan->merk = $request->merk;
        $simpan->harga_beli = $request->harga_beli;
        $simpan->harga_jual = $request->harga_jual;
        $simpan->stok = $request->stok;
        $simpan->min_stok = $request->min_stok;
        $simpan->save();

        Session::flash('sukses', 'Data barang berhasil disimpan.');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $request->id_barang,
            'nama_barang' => 'required|regex:/^[\pL\s\-\d]+$/u',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'min_stok' => 'required|numeric'
        ], [
            'kode_barang.required' => 'Kode Barang tidak boleh kosong',
            'kode_barang.unique' => 'Kode Barang sudah digunakan',
            'nama_barang.required' => 'Nama Barang tidak boleh kosong',
            'nama_barang.regex' => 'Nama Barang hanya diperbolehkan Huruf dan Angka',
            'harga_beli.required' => 'Harga Beli tidak boleh kosong',
            'harga_jual.required' => 'Harga Jual tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong',
            'harga_beli.numeric' => 'Harga Beli harus dalam format angka',
            'harga_jual.numeric' => 'Harga Jual harus dalam format angka',
            'stok.numeric' => 'Stok harus dalam format angka',
        ]);

        $simpan = Barang::find($request->id_barang);
        $simpan->kode_barang = $request->kode_barang;
        $simpan->nama_barang = $request->nama_barang;
        $simpan->barcode = $request->barcode;
        $simpan->merk = $request->merk;
        $simpan->harga_beli = $request->harga_beli;
        $simpan->harga_jual = $request->harga_jual;
        $simpan->min_stok = $request->min_stok;
        $simpan->save();

        Session::flash('sukses', 'Data barang berhasil diperbaharui.');

        return redirect(route('master_barang'));
    }

    public function delete($id)
    {
        $data = Barang::find($id);
        $data->status = 0;
        $data->save();

        Session::flash('sukses', 'Data barang berhasil dihapus.');

        return redirect()->back();
    }

    public function show($id)
    {
        // Mengambil data barang berdasarkan ID
        $barang = Barang::find($id);

        // Memeriksa apakah data ditemukan
        if ($barang) {
            return response()->json($barang);
        } else {
            return response()->json(['message' => 'Barang not found'], 404);
        }
    }
}
