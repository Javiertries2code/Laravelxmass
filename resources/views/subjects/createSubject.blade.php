@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Crear Asignatura</h1>
        <form action="{{ route('subject.storeSubject') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        @foreach($headers as $header)
                            <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="hours" placeholder="Horas">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="code" placeholder="Código">
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

@endsection
