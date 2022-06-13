<header class="main-header">
    <a href="{{ route('index') }}" class="logo">
        <span class="logo-mini"><b>E</b>SH</span>
        <span class="logo-lg"><b>EXPETASIA</b>shop</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"></a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dashboardpage/dist/img/user2-160x160.jpg') }}" class="user-image"
                             alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('dashboardpage/dist/img/user2-160x160.jpg') }}" class="img-circle"
                                 alt="User Image">
                            <p>
                                {{ auth()->user()->name }} - Admin
                                <small>Member since {{ auth()->user()->created_at->diffForHumans() }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
