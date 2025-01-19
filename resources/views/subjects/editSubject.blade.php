@extends('layouts.app')
@section('content')
    @if(isset($subject))
        <div class="container">
            <h1>Editar Asignatura</h1>
            <form action="{{ route('subject.updateSubject', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td>
                                <input type="text" class="form-control" name="code" value="{{ $subject->code }}" placeholder="{{ $subject->code }}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="hours" value="{{ $subject->hours }}" placeholder="{{ $subject->hours }}">
                            </td>
                            <td>
                                <select class="form-control" name="teacher_id">
                                    <option value="">Sin asignación o selecione un profesor</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ $teacher->id == $subject->teacher_id ? 'selected' : '' }}>{{ $teacher->name }} {{ $teacher->surname }} ({{ $teacher->email }})</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save-fill"></i> Guardar
                </button>
            </form>

            <div class="mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-info"><i class="bi bi-arrow-left-circle"></i> Volver</a>
            </div>
        </div>
    @endif
@endsection
