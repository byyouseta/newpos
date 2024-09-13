@extends('layouts.master')

@section('styles')
    <link href="{{ asset('template/dist/assets/plugin/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="col-lg-12 col-md-12">
        @if (Session::has('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('sukses') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ implode('', $errors->all(':message ')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif

        <div class="card table-card">
            <div class="card-header">
                {{-- <h5>Data Barang</h5> --}}
                <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal"
                    data-target="#exampleModalLive"><i class="feather icon-plus-circle"></i> Tambah</button>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i
                                            class="feather icon-maximize"></i> maximize</span><span style="display:none"><i
                                            class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                            class="feather icon-minus"></i> collapse</span><span style="display:none"><i
                                            class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i>
                                    reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i>
                                    remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-b-10 m-t-10 table-sm" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pelanggan</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $listData)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $listData->kode_pelanggan }}</td>
                                    <td>{{ $listData->nama }}</td>
                                    <td>{{ $listData->telepon }}</td>
                                    <td>{{ $listData->alamat }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master_pelanggan_edit', $listData->id) }}"
                                            class="text-warning"><i class="feather icon-edit"></i></a>
                                        <a href="{{ route('master_pelanggan_delete', $listData->id) }}"
                                            class="text-danger delete-confirm"><i class="feather icon-trash-2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @php
        $nextKode = $paddedNumber = str_pad($data->count() + 1, 5, '0', STR_PAD_LEFT);
        // dd($nextKode);
    @endphp

    {{-- Modal Tambah Barang --}}
    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('master_pelanggan_simpan') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kode Pelanggan</label>
                                    <input type="text" class="form-control" placeholder="Kode Pelanggan"
                                        name="kode_pelanggan" value="{{ old('kode_pelanggan', $nextKode) }}">
                                    @error('kode_pelanggan')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" class="form-control" placeholder="Nama Pelanggan"
                                        name="nama_pelanggan" value="{{ old('nama_pelanggan') }}">
                                    @error('nama_pelanggan')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="text" class="form-control" placeholder="Telepon" name="telepon"
                                        value="{{ old('telepon') }}">
                                    @error('telepon')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat" id="" cols="30" rows="10">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{-- <script src="https://cdn.datatables.net/v/bs4/dt-2.1.4/fc-5.0.1/r-3.0.2/datatables.min.js"></script> --}}
    <script src="{{ asset('template/dist/assets/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        new DataTable('#example', {
            info: true,
            ordering: false,
            paging: true
        });
    </script>
@endsection
