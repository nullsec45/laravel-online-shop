<nav
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
    data-aos="fade-down"
>
    <div class="container">
        <a href="{{route('home')}}" class="navbar-brand">
            <img src="{{url("/images/logo.svg")}}" alt="Logo" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route("categories.index")}}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                     <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="{{route('login')}}"
                            class="btn btn-success nav-link px-4 text-white"
                        >Sign In</a>
                    </li>
                @endguest
            </ul>

            @auth
                   <!-- Desktop Menu -->
            <ul class="navbar-nav d-none d-lg-flex">
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
                    Hi, {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu">
                    <a href="{{route('dashboard.index')}}" class="dropdown-item">Dashboard</a>
                    <a href="{{route('dashboard.settings.account')}}" class="dropdown-item"
                    >Settings</a>
                    <div class="dropdown-divider"></div>
                        <a href="{{route('logout')}}" 
                           class="dropdown-item" 
                           onclick="event.preventDefault();document.getElementById('logoout-form').submit()">
                            Logout
                        </a>

                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none"></form>
                    </div>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link d-inline-block mt-2">
                    <img src="{{url('/images/icon-cart-empty.svg')}}" alt="" />
                </a>
                </li>
            </ul>

            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                <a href="#" class="nav-link">
                    Hi, Angga
                </a>
                </li>
                <li class="nav-item">
                <a href="#" class="nav-link d-inline-block">
                    Cart
                </a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
