{{-- Existe una plantilla general para los usuarios "normales" --}}
{{-- 1: admins --}}


@if (Auth::check() &&
        (Auth::user()->user_type== 'God' || Auth::user()->user_type == 'admin'))

    @include('layouts.admin-app')

@elseif (Auth::check() )

    {{-- 2: usuarios normales --}}
    @include('layouts.nonadmin-app')

@else

    @include('layouts.guest-app')

@endif
