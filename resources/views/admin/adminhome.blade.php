@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        @foreach($data as $item)
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['title'] }}</h5>
                        <p class="card-text">{{ $item['text'] }}</p>
                        <a href="{{ $item['route'] }}" class="btn btn-primary">{{ $item['text'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
