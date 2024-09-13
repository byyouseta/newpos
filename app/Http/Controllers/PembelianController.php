<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Setting;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        session()->put('ibu', 'Transaksi');
        session()->put('anak', 'Pembelian');
        session()->forget('cucu');
        set_time_limit(0);

        $data = Pembelian::orderBy('created_at', 'DESC')
            ->get();

        $dataSupplier = Supplier::orderBy('nama', 'DESC')
            ->get();

        return view('pembelian.index', compact('data', 'dataSupplier'));
    }

    public function tambahTransaksi(Request $request)
    {

        // dd($request);
        // if ($request->supplier) {
        $new = new Pembelian();
        $new->supplier_id = $request->supplier;
        $new->user_id = Auth::user()->id;
        $new->tanggal = Carbon::now();
        $new->total_item = 0;
        $new->total_harga = 0;
        $new->diskon = 0;
        $new->ppn = 0;
        $new->bayar = 0;
        $new->pembayaran = 1;
        $new->save();

        $transaksiId = $new->id;
        // }

        // dd($lastInsertedId);
        return redirect()->route('pembelian_view', Crypt::encrypt($transaksiId));
    }

    public function viewTransaksi($id)
    {
        session()->put('ibu', 'Transaksi');
        session()->put('anak', 'Pembelian');
        session()->put('cucu', 'Tambah Pembelian');

        $transaksiId = Crypt::decrypt($id);

        // dd($id, $transaksiId);
        $dataSupplier = Supplier::orderBy('nama', 'DESC')
            ->get();

        $dataBarang = Barang::orderBy('nama_barang', 'DESC')
            ->get();

        if ($transaksiId) {
            $dataTransaksi = Pembelian::with('details')
                ->where('id', $transaksiId)->first();
        } else {
            $dataTransaksi = null;
        }

        // dd($dataTransaksi->detail_pembelian());

        return view('pembelian.tambah', compact('dataSupplier', 'dataBarang', 'dataTransaksi'));
    }

    public function store(Request $request)
    {
        session()->put('ibu', 'Transaksi');
        session()->put('anak', 'Pembelian');
        session()->put('cucu', 'Tambah Pembelian');

        // dd($request);
        // if (empty($pembelian_id)) {
        //     $new = new Pembelian();
        //     $new->supplier_id = $request->supplier;
        //     $new->total_item = 0;
        //     $new->total_harga = 0;
        //     $new->diskon = 0;
        //     $new->bayar = 0;
        //     $new->save();

        //     $transaksiId = $new->id;
        // } else {
        //     $transaksiId = $request->pembelian_id;
        // }
        $cek = DetailPembelian::where('pembelian_id', $request->pembelian_id)
            ->where('barang_id', $request->nama_barang)
            ->first();

        // dd($cek);

        if (empty($cek)) {
            $detail = new DetailPembelian();
            $detail->pembelian_id = $request->pembelian_id;
            $detail->barang_id = $request->nama_barang;
            $detail->harga_beli = $request->harga_beli;
            $detail->jumlah = $request->jumlah;
            $detail->subtotal = $request->subtotal;
            $detail->save();
        } else {
            // dd('masuk');
            $cek->harga_beli = $request->harga_beli;
            $cek->jumlah = $cek->jumlah + $request->jumlah;
            $cek->subtotal = $cek->subtotal + $request->subtotal;
            $cek->save();
        }


        //Update data stok
        $update = Barang::find($request->nama_barang);
        $update->stok = $update->stok + $request->jumlah;
        if ($request->update_harga_beli == TRUE) {
            $update->harga_beli = $request->harga_beli;
        }
        $update->save();

        return redirect()->back();
    }

    public function submitBayar(Request $request)
    {
        // dd($request);

        $update = Pembelian::find($request->pembelian_id);
        $update->total_item = $request->total_item;
        $update->total_harga = str_replace([',', '.'], '', $request->total_harga);
        $update->diskon = str_replace([',', '.'], '', $request->diskon);
        $update->bayar = str_replace([',', '.'], '', $request->bayar);
        $update->save();

        return redirect()->route('pembelian_index');
    }

    public function deleteBarang($id)
    {
        $transaksi = DetailPembelian::find(Crypt::decrypt($id));

        // dd($id, $transaksi);

        //Kurangi Stok
        $update = Barang::find($transaksi->barang_id);
        $update->stok = $update->stok - $transaksi->jumlah;
        $update->save();

        //Update harga nota
        $update2 = Pembelian::find($transaksi->pembelian_id);
        $update2->total_item = $update2->total_item - $transaksi->jumlah;
        $update2->total_harga = $update2->total_harga - $transaksi->subtotal;
        $update2->bayar = $update2->bayar - $transaksi->subtotal;
        $update2->save();

        //Hapus detail transaksi
        $transaksi->delete();

        return redirect()->back();
    }

    public function print($id)
    {
        $id = Crypt::decrypt($id);

        $setting = Setting::find(1);
        $data = Pembelian::find($id);

        return view('pembelian.cetak', compact('data', 'setting'));
    }
}
