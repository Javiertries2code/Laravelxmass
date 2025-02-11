@extends('layouts.app')
@section('content')
    <h1>Roles</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Eliminar roles</h2>
    <form method="POST" action="{{ route('admin.roledestroy') }}">
        @csrf
        @method('DELETE')
        <div class="form-row d-flex gap-1" style="max-width: 400px;">
            <div class="col">
                <input type="text" class="form-control" name="name" placeholder="Rol a eliminar">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash-fill"></i>

                </button>
            </div>
        </div>
    </form>
    {{-- <form method="POST" action=""> --}}

    <br/>
    <h2>Crear roles</h2>
    <form method="POST" action="{{ route('admin.rolcreate') }}">
        @csrf
        <div class="form-row d-flex gap-1" style="max-width: 400px;">
            <div class="col">
                <input type="text" class="form-control" name="name" placeholder="Nombre del nuevo rol">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success">Crear</button>
            </div>
        </div>
    </form>
@endsection
