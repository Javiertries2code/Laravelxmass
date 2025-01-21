@extends('layouts.app')

@section('content')

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Día</th>
            <th>Hora 1</th>
            <th>Hora 2</th>
            <th>Hora 3</th>
            <th>Hora 4</th>
            <th>Hora 5</th>
            <th>Hora 6</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($schedule as $sch)
        <tr>
            <td>{{ $sch->day_week }}</td>
            <td>{{ $sch->hour_1  }}</td>
            <td>{{ $sch->hour_2 }}</td>
            <td>{{ $sch->hour_3 }}</td>
            <td>{{ $sch->hour_4 }}</td>
            <td>{{ $sch->hour_5 }}</td>
            <td>{{ $sch->hour_6 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection
