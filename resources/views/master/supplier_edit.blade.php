@extends('layouts.master')

@section('styles')
@endsection

@section('content')
    <div class="col-lg-2 align-center">
        <a href="{{ route('master_supplier') }}" class="btn btn-primary"><i class="feather icon-arrow-left"></i> Master
            Supplier</a>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <form method="POST" action="{{ route('master_supplier_update') }}">
                @csrf
                <div class="card-header">
                    <h5 class="card-title">Edit Supplier</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Id Supplier" name="id_supplier"
                                    value="{{ $data->id }}">
                                <label>Kode Supplier</label>
                                <input type="text" class="form-control" placeholder="Kode Supplier" name="kode_supplier"
                                    value="{{ $data->kode_supplier }}">
                                @error('kode_supplier')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control" placeholder="Nama Supplier" name="nama_supplier"
                                    value="{{ $data->nama }}">
                                @error('nama_supplier')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" class="form-control" placeholder="Telepon" name="telepon"
                                    value="{{ $data->telepon }}">
                                @error('telepon')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" id="" cols="30" rows="3">{{ $data->alamat }}</textarea>
                                @error('alamat')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>List Barang</label>
                                <textarea class="form-control" name="list_barang" id="" cols="30" rows="4">{{ $data->list_barang }}</textarea>
                                @error('list_barang')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('master_supplier') }}" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
@endsection
