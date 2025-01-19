@extends('layouts.app')

@section('content')
    <h1>Crear nuevo curso</h1>
    <form action="{{ route('course.storeCoursewithsubject') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Codigo</label>
            <input type="text" class="form-control" name="code" placeholder="Codigo">
        </div>
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="name" placeholder="Nombre">
        </div>
        @for ($i = 1; $i <= 6; $i++)
        <div class="form-group mb-3">
            <label for="subject{{ $i }}" class="form-label">Asignatura {{ $i }}</label>
            <select class="form-control" id="subject{{ $i }}" name="subject{{ $i }}" required>
                <option value="">Seleccione una asignatura</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->code }}</option>
                @endforeach
            </select>
        </div>
        @endfor




        <button type="submit" class="btn btn-success">
            <i class="bi bi-save-fill"></i>
            Salvar
        </button>
    </form>
@endsection

