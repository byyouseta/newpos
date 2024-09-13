@extends('layouts.master')

@section('styles')
    <link href="{{ asset('template/dist/assets/plugin/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/dist/assets/plugin/select2/select2.min.css') }}" rel="stylesheet">
    <style>
        button.btn:focus {
            outline: none;
            /* Menghilangkan outline default */
            background-color: #28a745;
            /* Mengubah warna latar belakang menjadi hijau */
            color: white;
            /* Mengubah warna teks menjadi putih */
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
            /* Menambahkan efek shadow dengan warna hijau */
            border: 2px solid #28a745;
            /* Mengubah warna border menjadi hijau */
        }
    </style>
    <style>
        /* Pastikan Select2 sesuai dengan lebar form-control */
        .select2-container--default .select2-selection--single {
            height: calc(2.5rem + 2px);
            /* Sama dengan tinggi input Bootstrap */
            line-height: calc(2.5rem + 2px);
            /* Sama dengan tinggi input Bootstrap */
            border-radius: 0;
            /* Mengubah sudut menjadi kotak */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.5rem + 2px);
            /* Sama dengan tinggi input Bootstrap */
            border-radius: 0;
            /* Mengubah sudut menjadi kotak */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.5rem + 2px);
            /* Sama dengan tinggi input Bootstrap */
            top: 0;
            /* Menjaga posisi panah */
            border-radius: 0;
            /* Mengubah sudut menjadi kotak */
        }

        /* Atur Select2 dengan kelas kustom */
        .custom-select2 {
            width: 100%;
            /* Pastikan lebar 100% dari kontainer */
        }

        .select2-container--default .select2-selection--single {
            height: 100%;
            /* Menyesuaikan dengan tinggi kontainer */
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-9 align-center">
        {{-- <a href="{{ route('master_barang') }}" class="btn btn-primary"><i class="feather icon-arrow-left"></i> Master
            Barang</a> --}}
        <div class="card">
            <form method="POST" action="{{ route('pembelian_store') }}" id="myForm">
                @csrf
                <div class="card-header">
                    <h5 class="card-title">Tambah Transaksi Pembelian</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="nama_barang" id="barang_id" class="form-control select2 custom-select2"
                                    placeholder='Pilih' required tabindex="1">
                                    <option value="">Pilih</option>
                                    @foreach ($dataBarang as $listBarang)
                                        <option value="{{ $listBarang->id }}">{{ $listBarang->nama_barang }}</option>
                                    @endforeach
                                </select>
                                @error('nama_barang')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="supplier" id="hiddenSupplier">
                                <input type="hidden" class="form-control" name="pembelian_id"
                                    value="{{ $dataTransaksi->id ? $dataTransaksi->id : '' }}">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" placeholder="Kode Barang" name="kode_barang"
                                    id="kode_barang">
                                @error('kode_barang')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" placeholder="Harga Beli" name="harga_beli"
                                    id="nilai1" value="" tabindex="2">
                                @error('harga_beli')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control text-right" id="harga_beli" readonly>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="updateHargaBeli"
                                        data-toggle="popover" data-placement="bottom" title="Info"
                                        data-content="Update harga beli dengan harga beli barang terbaru"
                                        name="update_harga_beli" value="TRUE">
                                    <label class="form-check-label" for="updateHargaBeli">Update harga beli</label>
                                </div>
                                @error('harga_beli')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" tabindex="3" name="jumlah" id="nilai2">
                                @error('stok')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga Jual</label>
                                <input type="number" class="form-control text-right" id="harga_jual" readonly>
                                @error('stok')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Subtotal</label>
                                <input type="number" class="form-control" value="" tabindex="4" name="subtotal"
                                    id="total">
                                @error('harga_jual')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control" id="stok" readonly>
                                @error('stok')
                                    <small id="passwordHelpBlock"
                                        class="form-text text-muted text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right mb-2">
                        {{-- <a href="{{ route('master_barang') }}" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Tutup</a> --}}
                        <button type="submit" class="btn btn-primary" tabindex="5">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
        <div class="card">
            {{-- <div class="card-header">Data Transaksi</div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover m-b-10 m-t-10 table-sm" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th class="text-right">Jumlah</th>
                                <th class="text-right">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // dd($dataTransaksi->bayar);
                                $total = $totalItem = 0;
                            @endphp
                            @if ($dataTransaksi)
                                @foreach ($dataTransaksi->details as $no => $listBarang)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $listBarang->barang->kode_barang }}</td>
                                        <td>{{ $listBarang->barang->nama_barang }}</td>
                                        <td>{{ $listBarang->harga_beli }}</td>
                                        <td>{{ $listBarang->jumlah }}
                                            @php
                                                $totalItem = $totalItem + $listBarang->jumlah;
                                            @endphp
                                        </td>
                                        <td>
                                            {{ $listBarang->subtotal }}
                                            @php
                                                $total = $total + $listBarang->subtotal;
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('pembelian_delete_barang', Crypt::encrypt($listBarang->id)) }}"
                                                class="text-danger delete-confirm"><i
                                                    class="feather icon-trash-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">Data Transaksi</div>
            <div class="card-body">
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
                                <th class="text-right">Update Terakhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-3">
        <div class="card">
            <form action="{{ route('pembelian_bayar') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="pembelian_id"
                            value="{{ $dataTransaksi->id ? $dataTransaksi->id : '' }}">
                        <input type="hidden" class="form-control" name="total_item" value="{{ $totalItem }}">
                        <label>Nama Supplier</label>
                        <select name="supplier" id="supplier" class="form-control select2" required>
                            <option value="" disabled selected>Pilih</option>
                            @foreach ($dataSupplier as $listSupplier)
                                <option value="{{ $listSupplier->id }}"
                                    {{ $dataTransaksi->supplier_id == $listSupplier->id ? 'selected' : '' }}>
                                    {{ $listSupplier->nama }}</option>
                            @endforeach
                        </select>
                        @error('supplier')
                            <small id="passwordHelpBlock"
                                class="form-text text-muted text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                            </div>
                            <input type="text" class="form-control form-control-lg text-right"
                                placeholder="Total Harga" name="total_harga" id="total_harga"
                                value="{{ number_format($total, 0, '.', ',') }}" min="0" readonly>
                        </div>
                        @error('total_harga')
                            <small id="passwordHelpBlock"
                                class="form-text text-muted text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Diskon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                            </div>
                            <input type="number" class="form-control text-right form-control-lg " placeholder="Diskon"
                                name="diskon" value="0" min="0" id="diskon">
                        </div>
                        @error('diskon')
                            <small id="passwordHelpBlock"
                                class="form-text text-muted text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Bayar</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                            </div>
                            <input type="number" class="form-control form-control-lg text-right" placeholder="Bayar"
                                name="bayar"
                                value="{{ $dataTransaksi->bayar == 0 ? number_format($total, 0, ',', '.') : number_format($dataTransaksi->bayar, 0, ',', '.') }}"
                                min="0" id="bayar">
                        </div>
                        @error('bayar')
                            <small id="passwordHelpBlock"
                                class="form-text text-muted text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status Bayar</label>

                        @if ($dataTransaksi->bayar == 0)
                            <input type="text" class="form-control form-control-lg text-right font-bold text-danger"
                                value="Belum Bayar" readonly>
                        @else
                            @if ($dataTransaksi->bayar == $total)
                                <input type="text"
                                    class="form-control form-control-lg text-right font-bold text-success"
                                    value="Sudah Bayar" readonly>
                            @else
                                <input type="text" class="form-control form-control-lg text-right font-bold text-info"
                                    value="Kurang Bayar" readonly>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right mb-2">
                        <a href="{{ route('pembelian_index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('template/dist/assets/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/plugin/select2/select2.min.js') }}"></script>
    <script>
        new DataTable('#example', {
            info: true,
            ordering: false,
            paging: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            function calculateBayar() {
                var total = $('#total_harga').val().replace(/,/g, '');
                total = parseFloat(total) || 0;
                console.log(total);
                var diskon = parseFloat($('#diskon').val()) || 0;
                var bayar = formatNumber(total - diskon);
                $('#bayar').val(bayar);
            }

            $('#total_harga, #diskon').on('input', function() {
                calculateBayar();
            });

            //mengkalkulasi Subtotal
            function calculateTotal() {
                var nilai1 = parseFloat($('#nilai1').val()) || 0;
                var nilai2 = parseFloat($('#nilai2').val()) || 0;
                var total = nilai1 * nilai2;
                $('#total').val(total);
            }

            $('#nilai1, #nilai2').on('input', function() {
                calculateTotal();
            });

            //Mengambil data Supplier
            $('#supplier').on('change', function() {
                // Get the selected value
                var selectedValue = $(this).val();

                // Set the value of the input
                $('#hiddenSupplier').val(selectedValue);
            });

            // Optionally set the initial value if needed
            $('#hiddenSupplier').val($('#supplier').val());

            //Ambil data Barang
            $('#barang_id').on('change', function() {
                var barangId = $('#barang_id').val(); // Ambil ID dari input

                if (barangId) {
                    $.ajax({
                        url: '{{ url('/master/barang') }}/' +
                            barangId, // URL ke endpoint Laravel dengan ID
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.message) {
                                // Jika ada pesan, berarti data tidak ditemukan
                                alert(response.message);
                            } else {
                                // Isi elemen input dengan data dari server
                                $('#kode_barang').val(response.kode_barang);
                                $('#harga_beli').val(response.harga_beli);
                                $('#harga_jual').val(response.harga_jual);
                                $('#stok').val(response.stok);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ' + status + error);
                        }
                    });
                } else {
                    alert('Please enter an ID.');
                }
            });

            //Warning supplier
            $('#myForm').on('submit', function(event) {
                // Check the required input field outside of the form
                var outsideInput = $('#supplier');
                if (outsideInput.prop('required') && !outsideInput.val()) {
                    alert('Nama Supplier masih kosong!');
                    outsideInput.focus();
                    event.preventDefault(); // Prevent form submission
                    return;
                }
            });

            //format data nilai
            function formatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });
    </script>
@endsection
