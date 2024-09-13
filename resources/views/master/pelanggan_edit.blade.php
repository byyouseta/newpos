@extends('layouts.master')

@section('styles')
@endsection

@section('content')
    <div class="col-lg-2 align-center">
        <a href="{{ route('master_pelanggan') }}" class="btn btn-primary"><i class="feather icon-arrow-left"></i> Master
            Pelanggan</a>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <form method="POST" action="{{ route('master_pelanggan_update') }}">
                @csrf
                <div class="card-header">
                    <h5 class="card-title">Edit Pelanggan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Id Pelanggan" name="id_pelanggan"
                                    value="{{ $data->id }}">
                                <label>Kode Pelanggan</label>
                                <input type="text" class="form-control" placeholder="Kode Pelanggan"
                                    name="kode_pelanggan" value="{{ $data->kode_pelanggan }}">
                                @error('kode_pelanggan')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Pelanggan</label>
                                <input type="text" class="form-control" placeholder="Nama Pelanggan"
                                    name="nama_pelanggan" value="{{ $data->nama }}">
                                @error('nama_pelanggan')
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
                                <textarea class="form-control" name="alamat" id="" cols="30" rows="10">{{ $data->alamat }}</textarea>
                                @error('alamat')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('master_pelanggan') }}" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
@endsection
