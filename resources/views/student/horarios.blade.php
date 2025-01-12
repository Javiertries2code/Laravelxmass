@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Horarios de los estudiantes</h1>
        @foreach ($schedules as $i => $studentGroup)
        <h2 class="mb-4">{{ $i }}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora</th>
                    <th>Hora</th>
                    <th>Hora</th>
                    <th>Hora</th>
                    <th>Hora</th>
                    <th>Hora</th>
                    <th>Asignatura</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentGroup as $student)
                <tr>
                    <td>{{ $student->day_week }}</td>
                    <td>{{ $student->hour_1  }}</td>
                    <td>{{ $student->hour_2 }}</td>
                    <td>{{ $student->hour_3 }}</td>
                    <td>{{ $student->hour_4 }}</td>
                    <td>{{ $student->hour_5 }}</td>
                    <td>{{ $student->hour_6 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
@endsection
