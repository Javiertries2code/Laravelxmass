@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Meeting {{ $meeting->id }}</h1>
        <form method="POST" action="{{ route('meeting.update', $meeting->id) }}">
            @csrf
            @method('PUT')
            <table class="table">
                <tr>
                    <th>Dia</th>
                    <td>
                        <select class="form-control" name="day_week" required>
                            <option value="">Seleccione un dia</option>
                            <option value="LUNES" {{ $meeting->day_week == 'LUNES' ? 'selected' : '' }}>Lunes</option>
                            <option value="MARTES" {{ $meeting->day_week == 'MARTES' ? 'selected' : '' }}>Martes</option>
                            <option value="MIERCOLES" {{ $meeting->day_week == 'MIERCOLES' ? 'selected' : '' }}>Miercoles
                            </option>
                            <option value="JUEVES" {{ $meeting->day_week == 'JUEVES' ? 'selected' : '' }}>Jueves</option>
                            <option value="VIERNES" {{ $meeting->day_week == 'VIERNES' ? 'selected' : '' }}>Viernes</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Hora</th>
                    <td>
                        <select class="form-control" name="hour" required>
                            <option value="">Seleccione una hora</option>
                            <option value="1" {{ $meeting->hour == '1' ? 'selected' : '' }}>Hora 1</option>
                            <option value="2" {{ $meeting->hour == '2' ? 'selected' : '' }}>Hora 2</option>
                            <option value="3" {{ $meeting->hour == '3' ? 'selected' : '' }}>Hora 3</option>
                            <option value="4" {{ $meeting->hour == '4' ? 'selected' : '' }}>Hora 4</option>
                            <option value="5" {{ $meeting->hour == '5' ? 'selected' : '' }}>Hora 5</option>
                            <option value="6" {{ $meeting->hour == '6' ? 'selected' : '' }}>Hora 6</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Profesor</th>
                    <td>
                        <select class="form-control" name="teacher_id" required>
                            <option value="">Seleccione un profesor</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ $meeting->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}
                                    {{ $teacher->surname }} ({{ $teacher->email }})</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Alumno</th>
                    <td>
                        <select class="form-control" name="student_id" required>
                            <option value="">Seleccione un alumno</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $meeting->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}
                                    {{ $student->surname }} ({{ $student->email }})</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </td>

                </tr>

            </table>
        </form>

        <form action="{{ route('meeting.approveMeeting', $meeting->id) }}" method="POST">
            @csrf
            @method('POST')
            <table class="table">
                <tr>
                    <td colspan="2">
                        @if ($meeting->accepted)
                            <p class="text-success"> Este meeting esta aprobado</p>

                            <button type="submit" class="btn btn-danger" name="accepted" value="0">Desaprobar este
                                meeting</button>
                        @else
                            <p class="text-danger"> Este meeting esta pendiente de aprobacion</p>

                            <button type="submit" class="btn btn-success" name="accepted" value="1">Aprobar este
                                meeting</button>
                        @endif
                    </td>
                </tr>
            </table>
        </form>
    </div>
@endsection
