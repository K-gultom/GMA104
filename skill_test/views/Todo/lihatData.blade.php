@extends('main')

@section('title')
    Lihat Data 
@endsection

@section('content') 

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header"><strong>My</strong> Todo</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Todo</td>
                                    <td>:</td>
                                    <td>Isi dengan Data judul todo</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>Isi dengan data tanggal todo tersebut</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td>Isi dengan deskripsi kegiatan todo</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="container-fluid text-end">
                            <a href="{{ url('/home') }}" class="btn btn-success btn-sm">Oke <i class="bi bi-check"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection