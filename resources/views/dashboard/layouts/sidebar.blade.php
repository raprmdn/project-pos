@php
    $menus = [
        [
            'header' => 'MASTER',
            'menu' => [
                [
                    'name' => 'Kategori',
                    'route' => 'category.index',
                    'icon' => 'fa fa-cube',
                    'active' => request()->segment(2) == 'category',
                ],
                [
                    'name' => 'Unit',
                    'route' => 'unit.index',
                    'icon' => 'fa fa-cube',
                    'active' => request()->segment(2) == 'unit',
                ],
                [
                    'name' => 'Produk',
                    'route' => 'products.index',
                    'icon' => 'fa fa-cubes',
                    'active' => request()->segment(2) == 'products',
                ],
                [
                    'name' => 'Supplier',
                    'route' => '',
                    'icon' => 'fa fa-truck',
                    'active' => false,
                ],
            ],
        ],
        [
            'header' => 'TRANSACTION',
            'menu' => [
                [
                    'name' => 'Pembelian',
                    'route' => '',
                    'icon' => 'fa fa-handshake',
                    'active' => false,
                ],
                [
                    'name' => 'Penjualan',
                    'route' => '',
                    'icon' => 'fa fa-money-bill',
                    'active' => false,
                ],
                [
                    'name' => 'Transaksi',
                    'route' => '',
                    'icon' => 'fa fa-cart-arrow-down',
                    'active' => false,
                ],
            ],
        ],
        [
            'header' => 'REPORTS',
            'menu' => [
                [
                    'name' => 'Laporan Penjualan',
                    'route' => '',
                    'icon' => 'fa fa-file-pdf',
                    'active' => false,
                ],
            ],
        ],
        [
            'header' => 'ROLE & PERMISSIONS',
            'menu' => [
                [
                    'name' => 'Role',
                    'route' => 'roles.index',
                    'icon' => 'fas fa-crown',
                    'active' => request()->segment(3) == 'roles',
                ],
                [
                    'name' => 'Permissions',
                    'route' => 'permissions.index',
                    'icon' => 'fas fa-key',
                    'active' => request()->segment(3) == 'permissions',
                ],
            ],
        ],
        [
            'header' => 'SETTINGS',
            'menu' => [
                [
                    'name' => 'Profile',
                    'route' => '',
                    'icon' => 'fa fa-user',
                    'active' => false,
                ],
                [
                    'name' => 'Users',
                    'route' => '',
                    'icon' => 'fa fa-users',
                    'active' => false,
                ],
            ],
        ],
    ];
@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('index') }}" class="brand-link">
        <img src="{{ asset('dashboardpage/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Point of Sale</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dashboardpage/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->route()->getName() === 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @foreach($menus as $menu)
                    <li class="nav-header">{{ $menu['header'] }}</li>
                    @foreach($menu['menu'] as $submenu)
                        <li class="nav-item">
                            <a href="{{ $submenu['route'] ? route($submenu['route']) : '' }}" class="nav-link {{ $submenu['active'] ? 'active' : '' }}">
                                <i class="nav-icon {{ $submenu['icon'] }}"></i>
                                <p>{{ $submenu['name'] }}</p>
                            </a>
                        </li>
                    @endforeach
                @endforeach
                <li class="nav-header">SYSTEM</li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="nav-icon fa fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
