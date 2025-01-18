@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        @foreach($data as $item)
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if (isset($item['icon']))
                                <i class="bi {{ $item['icon'] }} me-2"></i>
                            @endif

                            {{ $item['title'] }}
                        </h5>
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
</div>
@endsection
