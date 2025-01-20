@extends('layouts.app')
@section('content')

    <div class="container">
        @if (!Auth::check())
            <div class="alert alert-warning" role="alert">
                No estas logueado <a href="{{ route('login') }}">Login</a>
            </div>
        @else
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('newmeeting') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> New Meeting
                </a>
            </div>
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
                        @foreach ($meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->id }}</td>
                                <td>{{ $meeting->day_week }}</td>
                                <td>{{ $meeting->hour }}</td>
                                <td>{{ $meeting->teacher_id }}</td>
                                <td>{{ $meeting->student_id }}</td>
                                <td>
                                    <div class="row align-items-center">
                                        @if ($meeting->accepted)
                                            <div class="col-md-auto alert alert-success text-center" role="alert">
                                                Aceptada
                                            </div>
                                        @else
                                            <div class="col-md-auto alert alert-warning text-center" role="alert">
                                                Pendiente
                                            </div>
                                        @endif
                                        @if (auth()->user()->can('teacher') || auth()->user()->can('student') || auth()->user()->can('admin'))
                                            <form class="col-md-auto"  action="{{ route('meetings.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="accepted" value="1">
                                                <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">

                                                @if (auth()->user()->can('teacher'))
                                                    <button type="submit" class="btn btn-sm btn-primary">Aprobar</button>
                                                @endif
                                            </form>
                                        @endif

                                        @if (auth()->user()->id == $meeting->student_id ||
                                                auth()->user()->id == $meeting->teacher_id ||
                                                auth()->user()->can('admin'))
                                            <form class="col-md-auto" action="{{ route('meeting.delete', $meeting->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
