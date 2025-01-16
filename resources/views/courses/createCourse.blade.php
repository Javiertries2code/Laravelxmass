@extends('layouts.app')

@section('content')
    <h1>Crear nuevo curso</h1>
    <form action="{{ route('course.storeCourse') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Codigo</label>
            <input type="text" class="form-control" name="code" placeholder="Codigo">
        </div>
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="name" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="">Elija maximo de 6 Asignaturas</label>
            <div class="d-flex flex-wrap">
                @for ($i = 0; $i < 6; $i++)
                    <div class="form-group m-2">
                        <input type="text" class="form-control" placeholder="Subject{{ $i + 1 }}">
                    </div>
                @endfor
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <ul>
            @foreach ($subjects as $subject)
                <li>{{ $subject->code }}</li>
            @endforeach
        </ul>

    </form>
@endsection

