
@extends('layouts.app')
@section('content')

<table>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
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
