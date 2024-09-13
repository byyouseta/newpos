@extends('layouts.master')

@section('styles')
    <style>
        .preview-image {
            max-width: 300px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-2 align-center">
        <a href="{{ route('setting_toko') }}" class="btn btn-primary"><i class="feather icon-arrow-left"></i> Setting
            Toko</a>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <form method="POST" action="{{ route('setting_toko_update') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h5 class="card-title">Edit Toko</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_tokosa" value="{{ $data->id }}">
                                <label>Nama Toko</label>
                                <input type="text" class="form-control" placeholder="Nama Toko" name="nama_toko"
                                    value="{{ $data->nama_toko }}">
                                @error('nama_toko')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat"
                                    value="{{ $data->alamat }}">
                                @error('alamat')
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
                                <label>Logo</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logoInput" name="file">
                                        <label class="custom-file-label" for="logoInput">Pilih gambar</label>
                                    </div>
                                </div>
                            </div>
                            @error('file')
                                <small id="passwordHelpBlock"
                                    class="form-text text-muted text-danger">{{ $message }}</small>
                            @enderror
                            <div class="mb-2">
                                <label>Preview</label>
                                {{-- <br> --}}
                                <div style="display: flex; justify-content: center;">
                                    @if ($data->path_logo)
                                        <img id="logoPreview" src="{{ asset($data->path_logo) }}" alt="Logo"
                                            style="border: 2px solid #adadad; border-radius: 10px; max-width: 300px; display: block;">
                                    @else
                                        <img id="logoPreview" src="{{ asset('template/dist/assets/images/photo.png') }}"
                                            alt="Logo"
                                            style="border: 2px solid #adadad; border-radius: 10px; max-width: 300px; display: block;">
                                    @endif

                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('setting_toko') }}" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
        // Preview Gambar Upload
        document.getElementById('logoInput').addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('logoPreview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
