<div class="d-flex flex-column flex-shrink-0 p-3">
    <div class="d-flex justify-content-between align-items-center mb-2 mb-md-0">

        @include('partials.logo')

        <div class="d-md-none">
            <button class="navbar-toggler border border-2 rounded-full pt-2 px-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#menuAdmin" aria-controls="menuAdmin" aria-expanded="false"
                aria-label="Muestra/Oculta el menu">
                <span class="navbar-toggler-icon bi bi-list"></span>
            </button>
        </div>
    </div>
    <div class="navbar-collapse collapse d-md-block" id="menuAdmin">
        <ul class="nav nav-pills flex-column mb-auto">

            <li>
                <a href="{{ route('admin.adminhome') }}"
                    class="nav-link {{ request()->routeIs('admin.adminhome') ? 'active' : '' }}">
                    Panel de administracion
                </a>
            </li>

            @foreach(App\Http\Controllers\AdminController::getCardsForDashboard() as $card)
                <li>
                    <a href="{{ $card['route'] }}" class="nav-link {{ request()->url() === $card['route'] || ($card['active'] ?? false) ? 'active' : '' }}">
                        @if (isset($card['icon']))
                            <i class="bi {{ $card['icon'] }} me-2"></i>
                        @endif
                        {{ $card['title'] }}

                    </a>


                </li>
            @endforeach


            <li>
                <hr />
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <hr>
</div>
