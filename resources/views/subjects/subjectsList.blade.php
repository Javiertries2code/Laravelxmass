/*************  ✨ Codeium Command ⭐  *************/
@extends('layouts.app')

@section('content')
    <h1>Lista de asignaturas</h1>
    <table class="table">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->code }}</td>
                <td>{{ $subject->hours }}</td>
                <td>
                    <form action="{{ route('subject.subjectDelete', $subject->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('subject.editSubject', $subject->id) }}" method="GET">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        <a href="{{ route('subject.createSubject') }}" class="btn btn-success">Crear nueva asignatura</a>
    </div>
@endsection

/******  65896239-92c2-479b-83ff-ac326d9bf2ef  *******/
