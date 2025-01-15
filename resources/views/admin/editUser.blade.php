@extends('layouts.app')
@section('content')
<form action="{{ route('admin.updateUser', $student->id) }}" method="POST">
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
                <input type="text" class="form-control" id="telephone_1" name="telephone_1" value="{{ $student->telephone_1 }}" placeholder="Telefono 1">
            </td>
        </tr>
        <tr>
            <th>Telefono 2</th>
            <td>
                <input type="text" class="form-control" id="telephone_2" name="telephone_2" value="{{ $student->telephone_2 }}" placeholder="Telefono 2">
            </td>
        </tr>
        <tr>
            <th>Rol actual</th>
            <td>
                {{ $student->roles->first()->name ?? 'No tiene rol' }}
            </td>
        </tr>
        <tr>
            <th>Rol</th>
            <td>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value="{{ $role->id }}"
                            id="{{ $role->id }}"
                            name="roles[]"
                            {{ $student->roles->contains('id', $role->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary">Editar</button>
            </td>
        </tr>
    </table>
</form>
@endsection
