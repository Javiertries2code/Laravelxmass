@extends('layouts.app')

@section('content')
/*************  ✨ Codeium Command ⭐  *************/
<div class="container">
    <h1>Crear Curso</h1>
    <form action="{{ route('course.storeCourse') }}" method="POST">
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
                        <input type="text" class="form-control" name="name" placeholder="Nombre">
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

/******  28feae1b-1eff-4050-9824-58c930c6348d  *******/

@endsection

