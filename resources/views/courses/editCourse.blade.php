
@extends('layouts.app')

@section('content')
@if(isset($course))
    <div class="container">
        <h1>Editar Curso</h1>
        <form action="{{ route('course.updateCourse', $course->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>
                            <input type="text" class="form-control" name="name" value="{{ $course->name }}" placeholder="{{ $course->name }}">
                        </td>
                       
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
@endif


@endsection
