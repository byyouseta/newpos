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
                {{-- <a href="{{ route('pembelian_tambah') }}" class="btn btn-primary btn-sm mr-2"><i
                        class="feather icon-plus-circle"></i> Tambah</a> --}}
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
                                <th>Supplier</th>
                                <th>Tanggal Buat</th>
                                <th class="text-right">Total Item</th>
                                <th class="text-right">Total Harga</th>
                                <th class="text-right">Diskon</th>
                                <th class="text-right">Bayar</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $listPembelian)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $listPembelian->supplier->nama }}</td>
                                    <td>{{ $listPembelian->created_at }}</td>
                                    <td class="text-right">{{ $listPembelian->total_item }}</td>
                                    <td class="text-right">{{ number_format($listPembelian->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($listPembelian->diskon, 0, ',', '.') }}</td>
                                    <td class="text-right">{{ number_format($listPembelian->bayar, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($listPembelian->bayar != 0)
                                            @if ($listPembelian->total_harga == $listPembelian->diskon + $listPembelian->bayar)
                                                <span class="badge badge-pill badge-primary">Lunas</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">Belum Lunas</span>
                                            @endif
                                        @else
                                            <span class="badge badge-pill badge-info">Transaksi Open</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pembelian_view', Crypt::encrypt($listPembelian->id)) }}"
                                            class="text-warning "><i class="feather icon-edit"></i></a>
                                        <a href="{{ route('pembelian_print', Crypt::encrypt($listPembelian->id)) }}"
                                            target="_blank" class="text-primary"><i class="feather icon-printer"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Tambah Barang --}}
    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('pembelian_tambah') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Supplier</label>
                                    {{-- <input type="text" class="form-control" placeholder="Kode Barang" name="kode_barang"> --}}
                                    <select name="supplier" id="" class="form-control" placeholder='Pilih'>
                                        @foreach ($dataSupplier as $listSupplier)
                                            <option value="{{ $listSupplier->id }}">{{ $listSupplier->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier')
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
