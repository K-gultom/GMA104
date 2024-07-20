@extends('main')
@section('title')
    Test Screen
@endsection
@section('content')

<div class="container-fluid">
    <div class="tex-center">
        <h1>Halo Tes Screen Data - A</h1>
        <form action="" method="POST">
            @csrf

            <input type="text" name="data1" id="" placeholder="Masukkan data-1">
            <input type="date" name="data2" id="" placeholder="Masukkan data-2">
            <input type="text" name="data3" id="" placeholder="Masukkan data-3">

            <button type="submit">Lanjut Belanja</button>
        </form>
    </div>
</div>
@endsection