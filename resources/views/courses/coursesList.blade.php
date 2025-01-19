
@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill"></i>

                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('course.editCourse', $course->id) }}" method="GET">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
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
