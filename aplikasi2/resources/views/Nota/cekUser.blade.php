<!-- resources/views/Nota/cekUser.blade.php -->

@extends('main')

@section('title')
    Cek User
@endsection

@section('content')
<div class="container-fluid">
    <h3 class="mb-3 mt-2">Cek User</h3>
    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Cek User</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>Barang Keluar</strong>
                </div>
                <div class="card-body">
                    @if($dataCekUserBuyer->isEmpty())
                        <p>No records found.</p>
                    @else
                        @foreach($dataCekUserBuyer as $date => $transactions)
                            <h5>User ID: {{ $transactions->first()->user_id }} - Date: {{ \Carbon\Carbon::parse(explode(' - ', $date)[1])->format('d/m/Y') }}</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
