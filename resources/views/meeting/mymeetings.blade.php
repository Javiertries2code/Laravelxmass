@extends('layouts.app')
@section('content')

<div class="container">
    @if(!Auth::check())
        <div class="alert alert-warning" role="alert">
            No estas logueado <a href="{{ route('login') }}">Login</a>
        </div>
    @else
    <div class="table-responsive">
        <table class="table">
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
                    <td>
                        @if($meeting->accepted)
                            <div class="alert alert-success" role="alert">
                                Aceptada
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                Pendiente
                            </div>
                        @endif
                        @if(auth()->user()->can('teacher' ) || auth()->user()->can('student') || auth()->user()->can('admin'))
                            <form action="{{ route('meetings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="accepted" value="1">
                                <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                                <button type="submit" class="btn btn-sm btn-primary">Aprobar</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

