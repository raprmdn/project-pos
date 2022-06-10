@php
$menus = [
    [
        'header' => 'MASTER',
        'menu' => [
            [
                'name' => 'Kategori',
                'route' => '#',
                'icon' => 'fa fa-cube',
                'active' => false,
            ],
            [
                'name' => 'Produk',
                'route' => '#',
                'icon' => 'fa fa-cubes',
                'active' => false,
            ],
            [
                'name' => 'Supplier',
                'route' => '#',
                'icon' => 'fa fa-truck',
                'active' => false,
            ],
        ]
    ],
    [
        'header' => 'TRANSACTION',
        'menu' => [
            [
                'name' => 'Pembelian',
                'route' => '#',
                'icon' => 'fa fa-handshake-o',
                'active' => false,
            ],
            [
                'name' => 'Penjualan',
                'route' => '#',
                'icon' => 'fa fa-money',
                'active' => false,
            ],
            [
                'name' => 'Transaksi',
                'route' => '#',
                'icon' => 'fa fa-cart-arrow-down',
                'active' => false,
            ],
        ]
    ],
    [
        'header' => 'REPORTS',
        'menu' => [
            [
                'name' => 'Laporan Penjualan',
                'route' => '#',
                'icon' => 'fa fa-file-pdf-o',
                'active' => false,
            ],
        ]
    ],
    [
        'header' => 'SETTINGS',
        'menu' => [
            [
                'name' => 'Profile',
                'route' => '#',
                'icon' => 'fa fa-user',
                'active' => false,
            ],
            [
                'name' => 'Users',
                'route' => '#',
                'icon' => 'fa fa-users',
                'active' => false,
            ],
        ]
    ],
    [
        'header' => 'SYSTEM',
        'menu' => [
            [
                'name' => 'Logout',
                'route' => '#',
                'icon' => 'fa fa-sign-out',
                'active' => false,
            ],
        ]
    ],
]
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboardpage/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>User Full Name</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            @foreach ($menus as $menu)
                <li class="header">{{ $menu['header'] }}</li>
                @foreach ($menu['menu'] as $submenu)
                    <li class="{{ $submenu['active'] ? 'active' : '' }}">
                        <a href="{{ $submenu['route'] }}">
                            <i class="{{ $submenu['icon'] }}"></i>
                            <span>{{ $submenu['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </section>
</aside>
