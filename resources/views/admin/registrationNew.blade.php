@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear nueva matriculación</h1>
        <form action="{{ route('admin.registrationStore') }}" method="POST">
            @csrf
            <input type="hidden" name="day" value="{{ date('Y-m-d') }}">

            <div class="form-group">
                <label for="course_id" class="form-label">Curso</label>
                <select class="form-control" id="course_id" name="course_id" required>
                    <option value="">Seleccione un curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="student_id" class="form-label">Estudiante</label>
                <select class="form-control" id="student_id" name="student_id" required>
                    <option value="">Seleccione un estudiante</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ (request()->query('user_id') == $student->id) ? 'selected' : '' }}>
                            {{ $student->name }} {{ $student->surname }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save-fill"></i> Salvar
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-info">
                    <i class="bi bi-arrow-left-circle"></i> Volver
                </a>
            </div>
        </form>
    </div>
@endsection

