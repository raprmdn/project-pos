@php
$menus = [
    [
        'header' => 'MASTER',
        'permissions' => 'view-master-menu',
        'menu' => [
            [
                'name' => 'Kategori',
                'route' => 'category.index',
                'icon' => 'fa fa-cube',
                'active' => request()->segment(2) == 'categories',
                'permissions' => 'view-category',
            ],
            [
                'name' => 'Unit',
                'route' => 'unit.index',
                'icon' => 'fa fa-cube',
                'active' => request()->segment(2) == 'units',
                'permissions' => 'view-unit',
            ],
            [
                'name' => 'Produk',
                'route' => 'products.index',
                'icon' => 'fa fa-cubes',
                'active' => request()->segment(2) == 'products',
                'permissions' => 'view-product',
            ],
            [
                'name' => 'Supplier',
                'route' => 'suppliers.index',
                'icon' => 'fa fa-truck',
                'active' => request()->segment(2) == 'suppliers',
                'permissions' => 'view-supplier',
            ],
        ],
    ],
    [
        'header' => 'TRANSACTION',
        'permissions' => 'view-transaction-menu',
        'menu' => [
            [
                'name' => 'Pembelian',
                'route' => 'orders.index',
                'icon' => 'fa fa-handshake',
                'active' => request()->segment(2) == 'orders',
                'permissions' => 'view-purchase',
            ],
            [
                'name' => 'Penjualan',
                'route' => 'sales.index',
                'icon' => 'fa fa-money-bill',
                'active' => request()->segment(2) == 'sales',
                'permissions' => 'view-sales',
            ],
            [
                'name' => 'Transaksi',
                'route' => 'transactions.create',
                'icon' => 'fa fa-cart-arrow-down',
                'active' => request()->segment(2) == 'transactions',
                'permissions' => 'create-transaction',
            ],
        ],
    ],
    [
        'header' => 'REPORTS',
        'permissions' => 'view-reports-menu',
        'menu' => [
            [
                'name' => 'Laporan Penjualan',
                'route' => 'reports.index',
                'icon' => 'fa fa-file-pdf',
                'active' => request()->segment(2) == 'reports',
                'permissions' => 'view-sales-reports',
            ],
        ],
    ],
    [
        'header' => 'ROLE & PERMISSIONS',
        'permissions' => 'view-role-and-permissions-menu',
        'menu' => [
            [
                'name' => 'Role',
                'route' => 'roles.index',
                'icon' => 'fas fa-crown',
                'active' => request()->segment(3) == 'roles',
                'permissions' => 'view-role',
            ],
            [
                'name' => 'Permissions',
                'route' => 'permissions.index',
                'icon' => 'fas fa-key',
                'active' => request()->segment(3) == 'permissions',
                'permissions' => 'view-permissions',
            ],
        ],
    ],
    [
        'header' => 'TRASH',
        'permissions' => 'view-trash-menu',
        'menu' => [
            [
                'name' => 'Products Trash',
                'route' => 'trash.products',
                'icon' => 'fas fa-trash-alt',
                'active' => request()->segment(3) == 'products',
                'permissions' => 'view-products-trash',
            ],
            [
                'name' => 'Categories Trash',
                'route' => 'trash.categories',
                'icon' => 'fas fa-trash-alt',
                'active' => request()->segment(3) == 'categories',
                'permissions' => 'view-categories-trash',
            ],
            [
                'name' => 'Units Trash',
                'route' => 'trash.units',
                'icon' => 'fas fa-trash-alt',
                'active' => request()->segment(3) == 'units',
                'permissions' => 'view-units-trash',
            ],
            [
                'name' => 'Suppliers Trash',
                'route' => 'trash.suppliers',
                'icon' => 'fas fa-trash-alt',
                'active' => request()->segment(3) == 'suppliers',
                'permissions' => 'view-suppliers-trash',
            ],
        ],
    ],
    [
        'header' => 'SETTINGS',
        'permissions' => 'view-settings-menu',
        'menu' => [
            [
                'name' => 'Users',
                'route' => 'users.index',
                'icon' => 'fa fa-users',
                'active' => request()->segment(2) == 'users',
                'permissions' => 'view-users',
            ],
        ],
    ],
];
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('index') }}" class="brand-link">
    <img src="{{ asset('dashboardpage/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Point of Sale</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dashboardpage/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->route()->getName() === 'dashboard'? 'active': '' }}">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @foreach ($menus as $menu)
          @can($menu['permissions'])
            <li class="nav-header">{{ $menu['header'] }}</li>
            @foreach ($menu['menu'] as $subMenu)
              @can($subMenu['permissions'])
                <li class="nav-item">
                  <a href="{{ $subMenu['route'] ? route($subMenu['route']) : '' }}"
                    class="nav-link {{ $subMenu['active'] ? 'active' : '' }}">
                    <i class="nav-icon {{ $subMenu['icon'] }}"></i>
                    <p>{{ $subMenu['name'] }}</p>
                  </a>
                </li>
              @endcan
            @endforeach
          @endcan
        @endforeach
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>Profile</p>
          </a>
        </li>
        <li class="nav-header">SYSTEM</li>
        <li class="nav-item">
          <a href="#" class="nav-link"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
