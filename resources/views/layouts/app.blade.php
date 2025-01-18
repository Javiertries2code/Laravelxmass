{{-- Existe una plantilla general para los usuarios "normales" --}}
{{-- 1: admins --}}
@if (Auth::check() &&
        (Auth::user()->getRoleNames()->first() == 'god' || Auth::user()->getRoleNames()->first() == 'admin'))
    @include('layouts.admin-app')
@else
{{-- 2: usuarios normales --}}
    @include('layouts.nonadmin-app')
@endif
