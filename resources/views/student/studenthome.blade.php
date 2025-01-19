@extends('layouts.app')
@section('content')
<div class="container">

    <h1>Cursos de <b>{{ $user->name }}</b> ({{ $user->id}}, {{ $user->email }})</h1>    {{-- @include('partials.tableData', ['data' => $matriculaciones, 'headers' => [ 'id' => 'id'] ]) --}}
    @include('partials.tableData', ['data' => $matriculaciones,
        'headers' => [ 'id' => 'id de la matricula', 'day' => 'Fecha de inicio', 'course_name_str' => 'Curso' ] ])

</div>
@endsection

