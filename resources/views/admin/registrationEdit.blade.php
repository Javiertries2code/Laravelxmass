@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <h1>Editar Matriculación</h1>
        <form action="{{ route('admin.registrationUpdate', $registration->id) }}" method="POST">
            @csrf
            @method('POST')



            <input type="hidden" name="day" value="{{ date('Y-m-d') }}">

            <table class="table">
                <tr>
                    <th>ID de la Matriculaci&oacute;n</th>
                    <td><input type="text" class="form-control" readonly id="id" name="id" value="{{ $registration->id }}"></td>
                </tr>
                <tr>
                    <th>Student ID</th>
                    <td><input type="text" class="form-control" readonly name="student_id" value="{{ $stundent_assigned->id ?? '' }}"></td>
                </tr>
                <tr>
                    <th>Nombre del Estudiante</th>
                    <td>{{ $stundent_assigned->name ?? 'No encontrado' }}</td>

                </tr>
                <tr>
                    <th>Fecha de inicio</th>
                    <td>{{ $registration->day }}</td>
                </tr>
                <tr>
                    <th>Asignatura</th>
                    <td>
                        <select class="form-control" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $course->id == $registration->course_id ? 'selected' : '' }}>
                                    {{ $course->code }} - {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save-fill"></i> Guardar
            </button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">
                <i class="bi bi-arrow-left-circle"></i> Cancelar
            </button>

        </form>
    </div>
@endsection
