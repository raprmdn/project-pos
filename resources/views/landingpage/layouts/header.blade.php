<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="{{ route('index') }}" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <h1>PoS<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ route('index') }}">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#services">Services</a></li>
                <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
                <li><a class="nav-link scrollto" href="#team">Team</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                @auth
                    <li class="dropdown"><a href="#"><span>{{ auth()->user()->name }}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="#">Profile Settings</a></li>
                            <li>
                                <a href="#"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form action="{{ route('logout') }}" id="logout-form" method="POST">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </nav>
        @auth
            <a class="btn-getstarted" href="{{ route('dashboard') }}">Dashboard</a>
        @endauth
        @guest
            <a class="btn-getstarted" href="{{ route('login') }}">Sign In</a>
        @endguest
    </div>
</header>
