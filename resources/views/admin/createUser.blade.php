
@extends('layouts.app')
@section('content')


<h1>Crear nuevo estudiante</h1>
<form action="{{ route('admin.storeNewUser') }}" method="POST">
    @csrf

    <table class="table">
        <tr>
            <th>Nombre</th>
            <td><input type="text" class="form-control" name="name" value="{{ old('name') }}"></td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td><input type="text" class="form-control" name="surname" value="{{ old('surname') }}"></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><input type="email" class="form-control" name="email" value="{{ old('email') }}"></td>
        </tr>
        <tr>
            <th>Telefono 1</th>
            <td><input type="text" class="form-control" name="telephone_1" value="{{ old('telephone_1') }}"></td>
        </tr>
        <tr>
            <th>Telefono 2</th>
            <td><input type="text" class="form-control" name="telephone_2" value="{{ old('telephone_2') }}"></td>
        </tr>
        <tr>
            <th>Rol</th>
            <td>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $role->id }}" id="{{ $role->id }}" name="roles[]">
                        <label class="form-check-label" for="{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </td>
        </tr>
    </table>
</form>

@endsection
