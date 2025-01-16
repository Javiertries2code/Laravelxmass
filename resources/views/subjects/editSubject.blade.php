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
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    @endif
@endsection
