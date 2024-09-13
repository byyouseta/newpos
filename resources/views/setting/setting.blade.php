@extends('layouts.master')

@section('styles')
    <style>
        .zoom-container {
            position: relative;
            display: inline-block;
        }

        .zoom-container img {
            display: block;
        }

        .zoom-container .zoom-lens {
            position: absolute;
            border: 3px solid #4CAF50;
            cursor: crosshair;
            width: 100px;
            height: 100px;
            opacity: 0.5;
            background-color: rgba(255, 255, 255, 0.5);
            display: none;
        }

        .zoom-container .zoom-result {
            position: absolute;
            border: 1px solid #4CAF50;
            width: 200px;
            height: 200px;
            overflow: hidden;
            display: none;
            top: 0;
            left: 100%;
            background-repeat: no-repeat;
        }

        table {
            width: 100%;
            /* Mengatur lebar tabel */
            height: 300px;
            /* Mengatur tinggi tabel */
            border-collapse: collapse;
            /* Menghilangkan jarak antara border sel */
        }
    </style>
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
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover m-b-10 m-t-10 table-sm">
                        <thead>
                            <tr>
                                <th>Nama Toko</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data)
                                <tr>
                                    <td>{{ $data->nama_toko }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->telepon }}</td>
                                    <td class="text-center">
                                        <div class="zoom-container">
                                            @if ($data->path_logo)
                                                <img src="{{ asset($data->path_logo) }}" alt="Logo Toko" width="300"
                                                    id="zoomImage" width="100">
                                            @else
                                                <img src="{{ asset('template/dist/assets/images/photo.png') }}"
                                                    alt="Logo Toko" id="zoomImage" width="100">
                                            @endif
                                            <div class="zoom-lens"></div>
                                            <div class="zoom-result"></div>
                                        </div>
                                    </td>
                                    <td><a href="{{ route('setting_toko_edit') }}" class="text-warning"><i
                                                class="feather icon-edit"></i></a></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const zoomImage = document.getElementById('zoomImage');
        const lens = document.querySelector('.zoom-lens');
        const result = document.querySelector('.zoom-result');

        zoomImage.addEventListener('mousemove', moveLens);
        lens.addEventListener('mousemove', moveLens);
        zoomImage.addEventListener('mouseleave', () => {
            lens.style.display = 'none';
            result.style.display = 'none';
        });

        function moveLens(e) {
            const rect = zoomImage.getBoundingClientRect();
            const lensWidth = lens.offsetWidth;
            const lensHeight = lens.offsetHeight;
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;

            if (x < lensWidth / 2) x = lensWidth / 2;
            if (x > rect.width - lensWidth / 2) x = rect.width - lensWidth / 2;
            if (y < lensHeight / 2) y = lensHeight / 2;
            if (y > rect.height - lensHeight / 2) y = rect.height - lensHeight / 2;

            lens.style.left = x - lensWidth / 2 + 'px';
            lens.style.top = y - lensHeight / 2 + 'px';
            lens.style.display = 'block';
            result.style.display = 'block';
            result.style.backgroundImage = `url(${zoomImage.src})`;
            result.style.backgroundSize = `${zoomImage.width * 2}px ${zoomImage.height * 2}px`;
            result.style.backgroundPosition = `-${(x * 2) - lensWidth}px -${(y * 2) - lensHeight}px`;
        }
    </script>
@endsection
