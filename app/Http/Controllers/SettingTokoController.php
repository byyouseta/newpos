<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingTokoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('ibu', 'Setting');
        session()->put('anak', 'Toko');
        session()->forget('cucu');
        set_time_limit(0);

        $data = Setting::find(1);

        return view('setting.setting', compact('data'));
    }

    public function edit()
    {
        session()->put('ibu', 'Setting');
        session()->put('anak', 'Toko');
        session()->put('cucu', 'Edit Toko');
        set_time_limit(0);

        $data = Setting::find(1);

        return view('setting.setting_edit', compact('data'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_toko' => 'required|regex:/^[\pL\s\-\d\.]+$/u',
            'alamat' => 'required|regex:/^[\pL\s\-\d\.]+$/u',
            'telepon' => 'required|numeric|digits_between:10,15',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'nama_toko.required' => 'Nama Pelanggan tidak boleh kosong.',
            'nama_toko.regex' => 'Nama Pelanggan hanya diperbolehkan Huruf dan Angka.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'alamat.regex' => 'Alamat hanya diperbolehkan Huruf dan Angka.',
            'list_barang.regex' => 'Nama Barang hanya diperbolehkan Huruf dan Angka.',
            'telepon.numeric' => 'Telepon harus dalam format angka.',
            'telepon.required' => 'Telepon harus diisi.',
            'telepon.digits_between' => 'Telepon harus min 10 digits max digits 15',
            'file.mimes' => 'File harus dalam format image',
            'file.max' => 'File tidak boleh lebih dari 2MB'
        ]);

        // dd($request);

        $update = Setting::find(1);
        $update->nama_toko = $request->nama_toko;
        $update->alamat = $request->alamat;
        $update->telepon = $request->telepon;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->extension(); // Membuat nama file unik
            $file->move(public_path('images'), $fileName); // Menyimpan file di folder public/images
            $update->path_logo = "images/$fileName";
        }
        $update->save();

        Session::flash('sukses', 'Data toko berhasil diperbaharui');
        return redirect()->route('setting_toko');
    }
}
