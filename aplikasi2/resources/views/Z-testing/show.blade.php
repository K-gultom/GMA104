@extends('main')
@section('title')
    Test Screen
@endsection
@section('content')

<div class="container-fluid">
    <div class="tex-center">
        <h1>Halo Tes Screen - Show</h1>
        <form action="{{ route('saveForm') }}" method="POST">
            @csrf

            <input readonly type="text" name="data1" id="" value="{{ $getData1 }}">
            <input readonly type="date" name="data2" id="" value="{{ $getData2 }}">
            <input readonly type="text" name="data3" id="" value="{{ $getData3 }}">

            <input type="text" name="data4" id="" placeholder="Isi Data Berikut">
            <input type="text" name="data5" id="" placeholder="Isi Data Berikut">
            <input type="text" name="data6" id="" placeholder="Isi Data Berikut">

            <button type="submit">Pesan sekarang</button>
        </form>
    </div>
</div>
@endsection