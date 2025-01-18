@if (Auth::check() &&
        (Auth::user()->getRoleNames()->first() == 'god' || Auth::user()->getRoleNames()->first() == 'admin'))
    <a class="navbar-brand" href="{{ route('admin.adminhome') }}">
    @else
        <a class="navbar-brand" href="{{ url('/') }}">
@endif
<img src="{{ asset('imagenes/EEM-logo-color.svg') }}" alt="Logo" width="120" height="80"
    class="d-inline-block align-text-top">
{{-- {{ config('app.name', 'Elorrieta') }} --}}
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
</button>
