@extends('layouts.app')
@section('content')
    <div class="container">

        <h1 class="mb-4">Cursos de <b>{{ $user->name }}</b> ({{ $user->id }}, {{ $user->email }})</h1>
        {{-- @include('partials.tableData', ['data' => $matriculaciones, 'headers' => [ 'id' => 'id'] ]) --}}

        <div class="accordion" id="accordionMatriculaciones">
            @foreach ($matriculaciones as $index => $matriculacion)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                            aria-controls="collapse{{ $index }}">
                            Matrícula ID: {{ $matriculacion->id }} -
                            Fecha de inicio: {{ $matriculacion->day }} -
                            Curso: <b class="text-primary">{{ strtoupper($matriculacion->course->name) }}</b>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionMatriculaciones">
                        <div class="accordion-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Id de la matrícula</th>
                                    <th>Fecha de inicio</th>
                                    <th>Asignaturas y profesores</th>
                                </tr>
                                <tr>
                                    <td>{{ $matriculacion->id }}</td>
                                    <td>{{ $matriculacion->day }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($matriculacion->course->subjects as $subject)
                                                <li>
                                                    {{ $subject->code }}
                                                    @if (isset($subject->user))
                                                        - <b> {{ $subject->user->name }}
                                                        </b> ({{ $subject->user->email }})
                                                    @endif

                                                </li>
                                            @endforeach
                                        </ul>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- esto funciona pero no muestra accordion claro --}}
        {{-- @include('partials.tableData', ['data' => $matriculaciones, --}}
        {{-- 'headers' => [ 'id' => 'id de la matricula', 'day' => 'Fecha de inicio', 'course_name_str' => 'Curso' ] ]) --}}

    </div>
@endsection
