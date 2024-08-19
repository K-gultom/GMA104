@extends('main')

@section('title')
Home
@endsection

@section('content') 
<div class="container-fluid">
    <h2>Home</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <strong>My</strong>
                    Todo</div>
                <div class="card-body">

                    {{-- @if (Session::has('message'))
                        <div class="alert alert-success" id="flash-message">
                            <strong>
                                {{Session::get('message')}}
                            </strong>
                        </div>
                        <script>
                            setTimeout(function () {
                                document
                                    .getElementById('flash-message')
                                    .style
                                    .display = 'none';
                            }, {{ session('timeout', 5000) }});
                        </script>
                    @endif --}}

                    <form class="d-flex p-5" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            name="search"
                            placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>

                        <a href="{{ url('/home') }}" class="mx-1 btn btn-outline-success btn-md">Refresh</a>
                    </form>

                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Todo</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                        <tbody>
                           <tr>
                                tampilkan data disini
                           </tr>
                        </tbody>
                    </table>
                    {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection