<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Supplier');
        session()->forget('cucu');
        set_time_limit(0);

        $data = Supplier::orderBy('created_at', 'DESC')
            ->get();

        return view('master.supplier', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => 'required|unique:suppliers,kode_supplier',
            'nama_supplier' => 'required|regex:/^[\pL\s\-\d]+$/u',
            'alamat' => 'regex:/^[\pL\s\-\d]+$/u|nullable',
            'list_barang' => 'regex:/^[\pL\s\-\d]+$/u|nullable',
            'telepon' => 'required|numeric|nullable|digits_between:10,15'
        ], [
            'kode_supplier.required' => 'Kode Pelanggan tidak boleh kosong.',
            'kode_supplier.unique' => 'Kode Pelanggan sudah digunakan.',
            'nama_supplier.required' => 'Nama Pelanggan tidak boleh kosong.',
            'nama_supplier.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'alamat.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'list_barang.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'telepon.numeric' => 'Telepon harus dalam format angka.',
            'telepon.required' => 'Telepon harus diisi.',
            'telepon.digits_between' => 'Telepon harus min 10 digits max digits 15',
        ]);

        $simpan = new Supplier();
        $simpan->kode_supplier = $request->kode_supplier;
        $simpan->nama = $request->nama_supplier;
        $simpan->alamat = $request->alamat;
        $simpan->list_barang = $request->list_barang;
        $simpan->telepon = $request->telepon;
        $simpan->save();

        Session::flash('sukses', 'Data supplier berhasil disimpan.');

        return redirect()->back();
    }

    public function edit($id)
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Supplier');
        session()->put('cucu', 'Edit Supplier');

        $data = Supplier::find($id);

        return view('master.supplier_edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier' => 'required|unique:suppliers,kode_supplier,' . $request->kode_supplier,
            'nama_supplier' => 'required|regex:/^[\pL\s\-\d]+$/u',
            'alamat' => 'regex:/^[\pL\s\-\d]+$/u|nullable',
            'list_barang' => 'regex:/^[\pL\s\-\d]+$/u|nullable',
            'telepon' => 'required|numeric|nullable|digits_between:10,15'
        ], [
            'kode_supplier.required' => 'Kode Supplier tidak boleh kosong.',
            'kode_supplier.unique' => 'Kode Supplier sudah digunakan.',
            'nama_supplier.required' => 'Nama Supplier tidak boleh kosong.',
            'nama_supplier.regex' => 'Nama Supplier hanya diperbolehkan Huruf dan Angka.',
            'alamat.regex' => 'Nama Supplier hanya diperbolehkan Huruf dan Angka.',
            'list_barang.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'telepon.numeric' => 'Telepon harus dalam format angka.',
            'telepon.required' => 'Telepon harus diisi.',
            'telepon.digits_between' => 'Telepon harus min 10 digits dan max digits 15',
        ]);

        $simpan = Supplier::find($request->id_supplier);
        $simpan->kode_supplier = $request->kode_supplier;
        $simpan->nama = $request->nama_supplier;
        $simpan->alamat = $request->alamat;
        $simpan->telepon = $request->telepon;
        $simpan->save();

        Session::flash('sukses', 'Data supplier berhasil diperbaharui.');

        return redirect(route('master_supplier'));
    }

    public function delete($id)
    {
        $data = Supplier::find($id);
        $data->delete();

        Session::flash('sukses', 'Data supplier berhasil dihapus.');

        return redirect()->back();
    }
}
