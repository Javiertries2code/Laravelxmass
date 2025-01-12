@extends('layouts.app')
@section('content')
    {{ var_dump(request()->all()) }}

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <form class="mt-2" name="create_platform" action="{{ route('meetings.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="alumno_email" class="form-label">Email Alumno</label>
                <input type="email" class="form-control" id="alumno_email" name="alumno_email" required />

            </div>
            <div class="form-group mb-3">
                <label for="teacher_email" class="form-label">Email Profesor</label>
                <input type="email" class="form-control" id="teacher_email" name="teacher_email" required />

            </div>
            <div class="form-group mb-3">
                <label for="dia" class="form-label"> Dia</label>
                <input type="texto" class="form-control" id="dia" name="dia" required />

            </div>

            <div class="form-group mb-3">
                <label for="hora" class="form-label"> hora</label>
                <input type="texto" class="form-control" id="hora" name="hora" required />

            </div>


            <button type="submit" class="btn btn-primary" name="">Request Meeting</button>
        </form>
    </div>
@endsection
