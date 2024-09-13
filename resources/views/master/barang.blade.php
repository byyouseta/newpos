@extends('layouts.master')

@section('styles')
    {{-- <link href="https://cdn.datatables.net/v/bs4/dt-2.1.4/fc-5.0.1/r-3.0.2/datatables.min.css" rel="stylesheet"> --}}
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
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th class="text-right">Harga Beli</th>
                                <th class="text-right">Harga Jual</th>
                                <th class="text-right">Stok</th>
                                <th class="text-right">Min Stok</th>
                                <th class="text-right">Update Terakhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $listBarang)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $listBarang->kode_barang }}</td>
                                    <td>{{ $listBarang->nama_barang }}</td>
                                    <td>{{ $listBarang->merk }}</td>
                                    <td class="text-right">{{ $listBarang->harga_beli }}</td>
                                    <td class="text-right">{{ $listBarang->harga_jual }}</td>
                                    <td class="text-right">{{ $listBarang->stok }}</td>
                                    <td class="text-right">{{ $listBarang->min_stok }}</td>
                                    <td class="text-right">{{ $listBarang->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master_barang_edit', $listBarang->id) }}"
                                            class="text-warning"><i class="feather icon-edit"></i></a>
                                        <a href="{{ route('master_barang_delete', $listBarang->id) }}"
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
    @endphp

    {{-- Modal Tambah Barang --}}
    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('master_barang_simpan') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" placeholder="Kode Barang" name="kode_barang"
                                        value="{{ $nextKode }}">
                                    @error('kode_barang')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" placeholder="Nama Barang"
                                        name="nama_barang">
                                    @error('nama_barang')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control" placeholder="Barcode" name="barcode">
                                    @error('barcode')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" class="form-control" placeholder="Merk" name="merk">
                                    @error('merk')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" class="form-control" placeholder="Harga Beli"
                                        name="harga_beli">
                                    @error('harga_beli')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" class="form-control" placeholder="Harga Jual"
                                        name="harga_jual">
                                    @error('harga_jual')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control" placeholder="Stok" name="stok">
                                    @error('stok')
                                        <small id="passwordHelpBlock"
                                            class="form-text text-muted text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Minimal Stok</label>
                                    <input type="number" class="form-control" placeholder="Minimal Stok"
                                        name="min_stok">
                                    @error('min_stok')
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
