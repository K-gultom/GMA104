@extends('main')

@section('title')
    Barang Masuk
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="mb-3 mt-2">Barang Masuk</h3>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/barang-masuk') }}">Barang Masuk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Barang Masuk</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-4 offset-3">
                <form action="" method="post">
                    @csrf
                    <div class="form-outline mb-4">
                        <label class="form-label" for="nama_barang_id"> Nama Barang</label>
                        <div class="input-group">
                            <span class="input-group-text text-light bg-primary"><i class="bi bi-person-bounding-box"></i></span>
                            <select name="id" class="form-control" id="nama_barang_id">
                                <option value="">--Pilih Nama Barang--</option>
                                @foreach ($getBarang as $item)
                                    <option value="{{ $item->id }}" {{ old('nama_barang_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->kode_barang }} ===> {{ $item->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="container-fluid text-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus"></i> input
                        </button>
                    </div>
        
                </form>
            </div>
        </div>


    </div>

@endsection