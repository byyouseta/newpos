<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>

    <!-- CSS untuk style cetak -->
    <style>
        @media print {
            .no-print {
                display: none;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
                margin: 1cm;
            }

            @page {
                margin: 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th {
                padding: 5px;
                text-align: center;
            }

            td {
                padding: 5px;
                text-align: left;
            }

            /* Style untuk kop menggunakan tabel */
            .kop-container {
                display: table;
                width: 100%;
                margin-bottom: 20px;
                border-bottom: 1px solid black;
                padding-bottom: 10px;
                text-align: center;
            }

            .kop-left,
            .kop-center,
            .kop-right {
                display: table-cell;
                /* vertical-align: middle; */
                padding: 5px;
            }

            .kop-left {
                width: 25%;
                text-align: left;
                vertical-align: middle;
                border-right: 1px solid transparent;
            }

            .kop-center {
                width: 50%;
                text-align: left;
                vertical-align: middle;
            }

            .kop-right {
                width: 25%;
                text-align: right;
                vertical-align: middle;
            }

            .kop img {
                width: 100px;
                height: auto;
            }

            .kop h1 {
                margin: 0;
                font-size: 18pt;
            }

            .kop p {
                margin: 0;
                padding: 0;
                font-size: 12pt;
            }

            .faktur {
                font-size: 24pt;
                font-weight: bold;
                margin: 0;
            }

            /* Style untuk info menggunakan tabel */
            .info {
                display: table;
                width: 100%;
                margin-bottom: 20px;
                border-bottom: 1px solid black;
                padding-bottom: 10px;
            }

            .info div {
                display: table-cell;
                width: 48%;
                vertical-align: top;
            }

            .info p {
                margin: 0;
                padding: 0;
            }

            .note {
                margin-top: 20px;
                font-size: 10pt;
            }

            .signature-container {
                display: flex;
                justify-content: space-between;
                margin-top: 30px;
                font-size: 10pt;
            }

            .signature {
                text-align: center;
                width: 40%;
            }

            .signature p {
                margin-top: 50px;
            }
        }

        body {
            font-family: Arial, sans-serif;
        }

        .title {
            text-align: center;
            font-size: 18pt;
            margin-bottom: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        button {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Tombol yang tidak ingin dicetak -->
    <button class="no-print" onclick="window.print()">Cetak Halaman</button>
    <button class="no-print" onclick="window.close()">Close Tab</button>

    <!-- Kop Toko -->
    <div class="kop-container">
        <div class="kop-left">
            <img src="{{ asset($setting->path_logo ? $setting->path_logo : 'template/dist/assets/images/photo.png') }}"
                alt="Logo Toko">
        </div>
        <div class="kop-center">
            <h1>{{ $setting->nama_toko }}</h1>
            <p>{{ $setting->alamat }}</p>
            <p>Telp: {{ $setting->telepon }}</p>
        </div>
        <div class="kop-right">
            <p class="faktur">FAKTUR</p>
        </div>
    </div>

    <!-- Informasi Pelanggan -->
    <div class="info">
        <div>
            <p><strong>Nama Pelanggan:</strong> {{ $data->supplier->nama }}</p>
            <p><strong>No. Telp:</strong> {{ $data->supplier->telepon }}</p>
            <p><strong>Alamat:</strong> {{ $data->supplier->alamat }}</p>
        </div>
        <div>
            <p><strong>Kasir:</strong> </p>
            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i:s') }}
            </p>
            <p><strong>No. Faktur:</strong> </p>
            <p><strong>Pembayaran:</strong> {{ $data->pembayaran }}</p>
        </div>
    </div>

    <!-- Konten yang ingin dicetak -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Batch & ED</th>
                <th>Harga</th>
                <th>Disc</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->details as $no => $list)
                <tr>
                    <td style="text-align: center">{{ ++$no }}</td>
                    <td>{{ $list->barang->nama_barang }}</td>
                    <td style="text-align: right">{{ $list->jumlah }}</td>
                    <td style="text-align: center">{{ $list->satuan }}</td>
                    <td>{{ $list->batch_ed }}</td>
                    <td style="text-align: right">{{ number_format($list->harga_beli, 0, ',', '.') }}</td>
                    <td style="text-align: right">{{ $list->diskon }}%</td>
                    <td style="text-align: right">{{ number_format($list->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align: right"><strong>Total</strong></td>
                <td style="text-align: right"><strong>{{ number_format($data->total_harga, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right"><strong>Diskon</strong></td>
                <td style="text-align: right"><strong>{{ number_format($data->diskon, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right"><strong>Pajak</strong></td>
                <td style="text-align: right"><strong>{{ number_format($data->pajak, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: right"><strong>Grand Total</strong></td>
                <td style="text-align: right"><strong>{{ number_format($data->bayar, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <!-- Catatan -->
    <div class="note">
        <p><strong>Catatan:</strong> Terimakasih telah berbelanja di {{ $setting->nama_toko }}. Semoga sehat selalu.
            <br>Maaf, barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.
        </p>
    </div>

    <!-- Paraf -->
    <div class="signature-container">
        <div class="signature">
            <p>Penerima / Pembeli</p>
            <p>_______________________</p>
        </div>
        <div class="signature">
            <p>{{ $setting->nama_toko }}</p>
            <p>_______________________</p>
        </div>
    </div>

    <!-- JavaScript untuk mencetak otomatis saat halaman load -->
    <script>
        window.onload = function() {
            window.print(); // Otomatis mencetak saat halaman dimuat
        };
    </script>

</body>

</html>
