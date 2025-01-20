
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

                    <tr>
                        <td>Asignaturas</td>
                        <td>
                            @foreach($subjects as $subject)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="{{ $subject->id }}" id="subject{{ $subject->id }}" {{ $course->subjects->contains($subject) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="subject{{ $subject->id }}">
                                        {{ $subject->code }}
                                    </label>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success bt5"><i class="bi bi-save-fill"></i> Salvar</button>
        </form>
    </div>
@endif


@endsection
