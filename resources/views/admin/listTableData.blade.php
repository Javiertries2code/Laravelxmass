@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center gap-5">
                <h1>{{ $title }}</h1>
                @if (isset($actions['create']))
                    <a href="{{ route($actions['create']) }}" title="Crear nuevo" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i>    Crear Nuevo
                    </a>
                @endif
            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @include('partials.tableData', ['headers' => $headers, 'data' => $data])


        @if (isset($actions['create']))
            <div class="mt-5 d-flex justify-content-end">
                <a href="{{ route($actions['create']) }}" class="btn btn-success">
                    Crear nuevo
                </a>
            </div>
        @endif
    </div> {{-- end container --}}
@endsection
