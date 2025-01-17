
@extends('layouts.app')
@section('content')

<table>
    <thead>
        <tr>
            <th>Meeting id</th>
            <th>Dia Semana</th>
            <th>Hora</th>
            <th>Teacher</th>
            <th>Student</th>
        </tr>
    </thead>
    <tbody>
        @foreach($meetings as $meeting)
        <tr>
            <td>{{ $meeting->id }}</td>
            <td>{{ $meeting->day_week }}</td>
            <td>{{ $meeting->hora }}</td>
            <td>{{ $meeting->teacher_id }}</td>
            <td>{{ $meeting->student_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
