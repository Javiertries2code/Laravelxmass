@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($cards as $item)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                @if (isset($item['icon']))
                                    <i class="bi {{ $item['icon'] }} me-2"></i>
                                @endif

                                {{ $item['title'] }}
                            </h5>
                            @if (isset($item['count']))
                                <div class="position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-secondary fs-4">{{ $item['count'] }}</span>
                                </div>
                            @endif


                            <p class="card-text">{{ $item['text'] }}</p>
                            <a href="{{ $item['route'] }}" class="btn btn-primary">
                                <i class="bi bi-list"></i>

                                {{ $item['text'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-calendar-check me-2"></i>
                            Reuniones aceptadas
                        </h5>
                        <p class="card-text">Cantidad de reuniones aceptadas por los estudiantes</p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-calendar-check me-2"></i>
                            Reuniones totales desde hoy
                        </h5>
                        <p class="card-text">Cantidad de reuniones totales por los estudiantes desde hoy</p>
                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge bg-secondary fs-4"></span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
