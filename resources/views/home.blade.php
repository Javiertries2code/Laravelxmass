@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Bienvenido, {{ Auth::user()->name }}.</p>

                    <p>Tipo de usuario: {{ Auth::user()->getRoleNames()->first() }}.</p>

                    <p>Tus roles son: {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}.</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
