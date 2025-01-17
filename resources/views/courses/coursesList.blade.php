
@extends('layouts.app')

@section('content')
    <h1>Lista de cursos</h1>
    <table class="table">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>
                    <select class="form-select">
                        @foreach($course->subjects as $subject)
                        <option>Asignaturas</option>
                            <option>{{ $subject->code }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <form action="{{ route('course.courseDelete', $course->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('course.editCourse', $course->id) }}" method="GET">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        <a href="{{ route('course.createCourse') }}" class="btn btn-success">Crear nuevo curso</a>
    </div>



@endsection
