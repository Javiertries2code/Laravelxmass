@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cursos</h5>
                    <p class="card-text">Ver cursos</p>
                    <a href="{{ route('course.coursesList') }}" class="btn btn-primary">Ver cursos</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Ver usuarios</p>
                    <a href="{{ route('admin.listsUsers') }}" class="btn btn-primary">Ver usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Estudiantes</h5>
                    <p class="card-text">Ver estudiantes</p>
                    <a href="{{ route('admin.listsStudents') }}" class="btn btn-primary">Ver estudiantes</a>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Roles</h5>
                    <p class="card-text">Ver roles</p>
                    <a href="{{ route('admin.roles') }}" class="btn btn-primary">Ver roles</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
