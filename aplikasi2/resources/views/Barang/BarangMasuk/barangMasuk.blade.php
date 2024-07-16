@extends('main')

@section('title')
    Barang Masuk
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="mb-3 mt-2">Barang Masuk</h3>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="w-100 pt-1">
                                <strong>Barang Masuk</strong>
                            </div>
                            <div class="w-100 text-end">
                                <a href="{{url('/barang-masuk')}}" class="btn btn-outline-primary btn-sm">
                                    Refresh Data <i class="bi bi-arrow-clockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="container-fluid mt-3 mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <form action="" method="get">
                                        <div class="row">
                                            <div class="col">
                                                <input type="date" value="{{ old('tanggal_awal') }}" name="tanggal_awal" id="tanggal_awal" class="form-control" />
                                                <sub><Strong>Tanggal Awal</Strong></sub>
                                            </div>
                                            <div class="col">
                                                <input type="date" value="{{ old('tanggal_akhir') }}" name="tanggal_akhir" id="tanggal_akhir" class="form-control" />
                                                <sub><Strong>Tanggal Akir</Strong></sub>
                                            </div>
                                            <div class="col-2">
                                                <button type="submit" class="btn btn-primary">Cari <i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" id="flash-message">
                                            <strong> {{Session::get('message')}} </strong>
                                        </div>
                                        <script>
                                            setTimeout(function (){
                                                document.getElementById('flash-message').style.display='none';
                                            }, {{ session('timeout', 5000) }});
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <th>No</th>
                                <th class="text-center">Tanggal Faktur</th>
                                <th>Nama Barang</th>
                                <th>Suplier</th>
                                <th>Harga Beli</th>
                                <th class="text-center">Jumlah Masuk</th>
                                <th class="text-center">Admin</th>
                                <th class="text-center">Cabang</th>
                            </thead>
                            <tbody>
                                @foreach($getData as $item)
                                    <tr>
                                        <td>
                                            {{ (($getData->currentPage() - 1) * $getData->perPage()) + $loop->iteration }} 
                                        </td>
                                        <td class="text-center">{{ Carbon\Carbon::parse( $item->tanggal_faktur )->format('d/m/Y') }}</td>
                                        <td>{{ $item->getStok->nama_barang }}</td>
                                        <td>{{ $item->getSuplier->nama_suplier }}</td>
                                        <td>{{ 'Rp ' . number_format($item->harga_beli, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->jumlah_barang_masuk }}</td>
                                        <td class="text-center">{{ $item->getAdmin->name }}</td>
                                        <td class="text-center">{{ $item->cabang }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $getData->links() }}
                        </table>

                        <div class="container-fluid text-end">
                            <a href="{{ url('/barang-masuk/add') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection