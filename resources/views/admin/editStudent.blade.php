@extends('layouts.app')
@section('content')
<form action="{{ route('admin.updateStudent', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <table class="table">
        <tr>
            <th>Nombre</th>
            <td>
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" placeholder="Nombre">
            </td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td>
                <input type="text" class="form-control" id="surname" name="surname" value="{{ $student->surname }}" placeholder="Apellido">
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" placeholder="Email">
            </td>
        </tr>
        <tr>
            <th>Telefono 1</th>
            <td>
                <input type="text" class="form-control" id="telephone1" name="telephone1" value="{{ $student->telephone1 }}" placeholder="Telefono 1">
            </td>
        </tr>
        <tr>
            <th>Telefono 2</th>
            <td>
                <input type="text" class="form-control" id="telephone2" name="telephone2" value="{{ $student->telephone2 }}" placeholder="Telefono 2">
            </td>
        </tr>
        <tr>
            <th>Rol actual</th>
            <td>
                {{ $student->roles->first()->name ?? 'No tiene rol' }}
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </td>

            <td colspan="2">
                <a href="{{ url()->previous() }}" class="btn btn-info">Volver</a>
            </td>

        </tr>
    </table>
</form>
@endsection


