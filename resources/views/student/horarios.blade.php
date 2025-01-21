@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mb-4">Horarios de los estudiantes</h1>
        @foreach ($schedules as $i => $studentHorarios)
            <h2 class="mb-4"> Curso {{ $studentHorarios->first()->course->name }} </h2>

            <table class="table table-striped table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Día</th>
                        @for ($i = 1; $i <= 6; $i++)
                            <th scope="col">Hora {{ $i }}</th>
                        @endfor

                    </tr>
                </thead>

                <tbody>
                    @foreach ($studentHorarios as $diadelasemana)
                        <tr>
                            <th scope="row"> {{ $diadelasemana->day_week }}
                            </th>
                            @for ($i = 1; $i <= 6; $i++)
                                <td>
                                    @php $hour_var = "hour_$i"; @endphp
                                    @if ($diadelasemana->course->subjects->where('id', $diadelasemana->$hour_var)->first())
                                        {{ $diadelasemana->course->subjects->where('id', $diadelasemana->$hour_var)->first()->code }}
                                    @else
                                        <span class="text-danger">No existe asignatura</span>
                                    @endif
                                </td>
                            @endfor

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection

