@extends('layouts.app')
@section('content')
    {{ var_dump(request()->all()) }}


    <div class="container">
        <form class="mt-2" name="create_platform" action="{{ route('meetings.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

<div class="form-group mb-3">
    <label for="alumno_email" class="form-label">Email Alumno</label>
    <input type="email" class="form-control" id="alumno_email" name="alumno_email" value="{{ auth()->user()->email }}" placeholder="{{ auth()->user()->email }}" required />
</div>
            <div class="form-group mb-3">
                <label for="teacher_email" class="form-label">Profesor</label>
                <select class="form-control" id="teacher_email" name="teacher_email" required>
                    <option value="">Seleccione un profesor</option>
                    @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->email }}">{{ $teacher->name }} {{ $teacher->surname }} ({{ $teacher->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="dia" class="form-label">Dia</label>
                <select class="form-control" id="dia" name="dia" required>
                    <option value="">Seleccione un día</option>
                    <option value="LUNES">Lunes</option>
                    <option value="MARTES">Martes</option>
                    <option value="MIERCOLES">Miércoles</option>
                    <option value="JUEVES">Jueves</option>
                    <option value="VIERNES">Viernes</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="hora" class="form-label">Hora</label>
                <select class="form-control" id="hora" name="hora" required>
                    <option value="">Seleccione una hora</option>
                    <option value="1">Hora 1</option>
                    <option value="2">Hora 2</option>
                    <option value="3">Hora 3</option>
                    <option value="4">Hora 4</option>
                    <option value="5">Hora 5</option>
                    <option value="6">Hora 6</option>
                </select>


            </div>




            <button type="submit" class="btn btn-primary" name="">Request Meeting</button>
        </form>
    </div>
@endsection
