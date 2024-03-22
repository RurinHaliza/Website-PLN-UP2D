<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PLN UP2D Jatim</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PLN</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('dashboard.admin') }}">Main Menu</a>
            </li>
            <li class="menu-header">Tabel Monitoring Beban</li>

            <li class='{{ Request::is('bebanharian') ? 'active' : '' }}'>

                <a class="nav-link" href="{{ route('bebanharian') }}"><i class="fas fa-th-large"></i>Beban Harian</a>
            </li>
            <li class='{{ Request::is('bebanminggu') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('bebanminggu') }}"><i class="fas fa-th-large"></i>Beban Mingguan</a>
            </li>
            <li class='{{ Request::is('bebanbulan') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('bebanbulan') }}"><i class="fas fa-th-large"></i>Beban Bulanan</a>
            </li>
            </li>
            <li class="menu-header">Tabel Beban</li>

            <li class='{{ Request::is('bebantrafo') ? 'active' : '' }}'>

                <a class="nav-link" href="{{ route('bebantrafo') }}"><i class="fas fa-fw fa-boxes-alt"></i>Tabel Beban
                    Trafo</a>
            </li>
            <li class='{{ Request::is('bebanpenyulang') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('bebanpenyulang') }}"><i class="fas fa-fw fa-hourglass"></i>Tabel Beban
                    Penyulang</a>
            </li>
            <li class='{{ Request::is('bebanup3') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('bebanup3') }}"><i class="fas fa-th-large"></i>Tabel Beban UP3</a>
            </li>
            </li>
            <li class='{{ Request::is('bebanktt') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ route('bebanktt') }}"><i class="fas fa-th-large"></i>Tabel Beban KTT</a>
            </li>

            <li class="menu-header">Manajemen User</li>

            <li class='{{ Request::is('user.admin') ? 'active' : '' }}'>

                <a class="nav-link" href="{{ route('user.admin') }}"><i class="fas fa-user-alt"></i>User</a>
            </li>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a class="btn btn-primary btn-lg btn-block btn-icon-split" href=""
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-arrow-left"></i>{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout.post') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </aside>
</div>
