@extends('layouts.app')
@section('content')
    <h1>Lista de usuarios</h1>
   

    {{-- probando tabla cebreada --}}
    <table class="table table-striped">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach

            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->surname }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->user_type }}</td>

                    <td>{{ $student->telephone1 }}</td>
                    <td>{{ $student->telephone2 }}</td>
                    {{-- <td>{{ $student->registration_id }}</td> --}}

                    <td>
                        <!-- Botón para eliminar -->
                        <form action="{{ route('admin.deleteUser', ['id' => $student->id]) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit"
                                onclick="return confirm('¿Está seguro de eliminar este usuario? {{ $student->id }}?')">
                                Eliminar
                            </button>
                        </form>

                        <!-- Botón para editar -->
                        <form action="{{ route('admin.editUser', ['id' => $student->id]) }}" method="GET"
                            style="display: inline-block;">
                            <button class="btn btn-sm btn-warning" type="submit">
                                Editar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div>    {{ $students->links() }} --}}
    </div>
@endsection
