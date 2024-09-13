<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Pelanggan');
        session()->forget('cucu');
        set_time_limit(0);

        $data = Pelanggan::orderBy('created_at', 'DESC')
            ->get();

        return view('master.pelanggan', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan',
            'nama_pelanggan' => 'required|regex:/^[\pL\s\-\d]+$/u',
            'alamat' => 'regex:/^[\pL\s\-\d]+$/u|nullable',
            'telepon' => 'numeric|nullable|digits_between:10,15'
        ], [
            'kode_pelanggan.required' => 'Kode Pelanggan tidak boleh kosong.',
            'kode_pelanggan.unique' => 'Kode Pelanggan sudah digunakan.',
            'nama_pelanggan.required' => 'Nama Pelanggan tidak boleh kosong.',
            'nama_pelanggan.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'alamat.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'telepon.numeric' => 'Telepon harus dalam format angka.',
            'telepon.digits_between' => 'Telepon min 10 digits dan max 15 digits',
        ]);

        $simpan = new Pelanggan();
        $simpan->kode_pelanggan = $request->kode_pelanggan;
        $simpan->nama = $request->nama_pelanggan;
        $simpan->alamat = $request->alamat;
        $simpan->telepon = $request->telepon;
        $simpan->save();

        Session::flash('sukses', 'Data pelanggan berhasil disimpan.');

        return redirect()->back();
    }

    public function edit($id)
    {
        session()->put('ibu', 'Master');
        session()->put('anak', 'Pelanggan');
        session()->put('cucu', 'Edit Pelanggan');

        $data = Pelanggan::find($id);

        return view('master.pelanggan_edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'kode_pelanggan' => 'required|unique:pelanggans,kode_pelanggan,' . $request->kode_pelanggan,
            'nama_pelanggan' => 'required|regex:/^[\pL\s\-]+$/u',
            'alamat' => 'regex:/^[\pL\s\-]+$/u|nullable',
            'telepon' => 'numeric|nullable|digits_between:10,15'
        ], [
            'kode_pelanggan.required' => 'Kode Pelanggan tidak boleh kosong.',
            'kode_pelanggan.unique' => 'Kode Pelanggan sudah digunakan.',
            'nama_pelanggan.required' => 'Nama Pelanggan tidak boleh kosong.',
            'nama_pelanggan.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'alamat.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'telepon.numeric' => 'Telepon harus dalam format angka.',
            'telepon.digits_between' => 'Telepon min 10 digits dan max 15 digits',
        ]);

        $simpan = Pelanggan::find($request->id_pelanggan);
        $simpan->kode_pelanggan = $request->kode_pelanggan;
        $simpan->nama = $request->nama_pelanggan;
        $simpan->alamat = $request->alamat;
        $simpan->telepon = $request->telepon;
        $simpan->save();

        Session::flash('sukses', 'Data pelanggan berhasil diperbaharui.');

        return redirect(route('master_pelanggan'));
    }

    public function delete($id)
    {
        $data = Pelanggan::find($id);
        $data->delete();

        Session::flash('sukses', 'Data pelanggan berhasil dihapus.');

        return redirect()->back();
    }
}
