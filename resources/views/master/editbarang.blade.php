@extends('layouts.master')

@section('styles')
@endsection

@section('content')
    <div class="col-lg-2 align-center">
        <a href="{{ route('master_barang') }}" class="btn btn-primary"><i class="feather icon-arrow-left"></i> Master
            Barang</a>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <form method="POST" action="{{ route('master_barang_update') }}">
                @csrf
                <div class="card-header">
                    <h5 class="card-title">Edit Barang</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_barang" value="{{ $data->id }}">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" placeholder="Kode Barang" name="kode_barang"
                                    value="{{ $data->kode_barang }}">
                                @error('kode_barang')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang"
                                    value="{{ $data->nama_barang }}">
                                @error('nama_barang')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Barcode</label>
                                <input type="text" class="form-control" placeholder="Barcode" name="barcode"
                                    value="{{ $data->barcode }}">
                                @error('barcode')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control" placeholder="Merk" name="merk"
                                    value="{{ $data->merk }}">
                                @error('merk')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" placeholder="Harga Beli" name="harga_beli"
                                    value="{{ $data->harga_beli }}">
                                @error('harga_beli')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" class="form-control" placeholder="Harga Jual" name="harga_jual"
                                    value="{{ $data->harga_jual }}">
                                @error('harga_jual')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control" placeholder="Stok" name="stok"
                                    value="{{ $data->stok }}">
                                @error('stok')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('master_barang') }}" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
@endsection
