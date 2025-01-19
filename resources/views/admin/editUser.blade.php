@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST" class="form-responsive">
            @csrf
            @method('PUT')
            <table class="table table-responsive">
                <tr>
                    <th>Nombre</th>
                    <td>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            placeholder="Nombre">
                    </td>
                </tr>
                <tr>
                    <th>Apellido</th>
                    <td>
                        <input type="text" class="form-control" id="surname" name="surname"
                            value="{{ $user->surname }}" placeholder="Apellido">
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $user->email }}" placeholder="Email">
                    </td>
                </tr>
                <tr>
                    <th>Telefono 1</th>
                    <td>
                        <input type="text" class="form-control" id="telephone1" name="telephone1"
                            value="{{ $user->telephone1 }}" placeholder="Telefono 1">
                    </td>
                </tr>
                <tr>
                    <th>Telefono 2</th>
                    <td>
                        <input type="text" class="form-control" id="telephone2" name="telephone2"
                            value="{{ $user->telephone2 }}" placeholder="Telefono 2">
                    </td>
                </tr>
                <tr>
                    <th>Tipo usuario</th>
                    <td>{{ $user->user_type }}</td>
                </tr>
                <tr>
                    <th>Rol</th>
                    <td>
                        @foreach ($roles as $role)
                            {{-- trying to make it appear only if the role is god, ans user is god 1 --}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}"
                                    id="{{ $role->id }}" name="roles[]"
                                    {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save-fill"></i> Guardar
                        </button>
                    </td>

                    <td colspan="2">
                        <a href="{{ route('admin.registrationNew') }}?user_id={{ $user->id }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Crear Matriculacion
                        </a>
                    </td>


                    @if(url()->previous() && url()->previous() != url()->current())
                        <td colspan="2">
                            <a href="{{ url()->previous() }}" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>
                        </td>
                    @endif

                </tr>
            </table>
        </form>
    </div>
@endsection
