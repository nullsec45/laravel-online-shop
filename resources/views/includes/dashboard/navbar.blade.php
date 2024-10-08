<button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Desktop Menu -->
    <ul class="navbar-nav d-none d-lg-flex ml-auto">
        <li class="nav-item dropdown">
            <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
            >
                <img
                    src="{{url('/images/icon-user.png')}}"
                    alt=""
                    class="rounded-circle mr-2 profile-picture"
                />
                {{Auth::user()->name}}
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('dashboard.index') }}" class="dropdown-item">Dashboard</a>
                <a href="{{ route('dashboard.settings.account') }}" class="dropdown-item">
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>