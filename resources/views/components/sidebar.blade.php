<div id="sidebar" class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">PLN UP2D Jatim</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">PLN</a>
        </div>
        <ul class="sidebar-menu">

            @if (Auth::user()->hasRole('Administrator'))
                <li class="menu-header">Dashboard</li>
                <li class="{{ Request::is('Admin/Dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard.admin') }}"><i class="far fa-square"></i> <span>Main
                            Menu</span></a>
                </li>
                <li class="menu-header">Tabel Monitoring Beban</li>
                <li class="{{ Request::is('Admin/bebansemua') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebansemua') }}"><i class="fas fa-th-large"></i>
                        <span>Beban</span></a>
                </li>
                </li>
                <li class="menu-header">Tabel Beban</li>
                <li class="{{ Request::is('dataform.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dataform.index') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                        <span>Tabel Data Form Bulanan</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebantrafo') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebantrafo') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                        <span>Tabel Beban Trafo</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebanpenyulang') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebanpenyulang') }}"><i class="fas fa-fw fa-hourglass"></i>
                        <span>Tabel Beban Penyulang</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebanktt') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebanktt') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                            KTT</span></a>
                </li>
                <li class="{{ Request::is('Admin/BebanGI') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('beban.GI') }}"><i class="fas fa-th-large"></i> <span>Tabel
                            Beban GI</span></a>
                </li>
                <li class="{{ Request::is('data.mvcell') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('data.mvcell') }}"><i class="fas fa-th-large"></i> <span>Tabel
                            Data MVCELL</span></a>
                </li>
                <li class="menu-header">Manajemen User</li>
                <li class="{{ Request::is('Admin/UserManagement') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.admin') }}"><i class="fas fa-user-alt"></i>
                        <span>User</span></a>
                </li>
        </ul>
    @elseif(Auth::user()->hasRole('operator'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.operator') }}"><i class="far fa-square"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.operator') }}"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        <li class="menu-header">Scada Fail</li>
        <li class="{{ Request::is('scadafail') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('scadafail') }}"><i class="fas fa-th-large"></i> <span>Input Scada
                    Fail</span></a>
        </li>
        </li>

        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('trafo.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('trafo.operator') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel Beban Trafo</span></a>
        </li>
        <li class="{{ Request::is('penyulang.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penyulang.operator') }}"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="{{ Request::is('ktt.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ktt.operator') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('GI.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('GI.operator') }}"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.operator') }}"><i class="fas fa-th-large"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>

        
    @elseif(Auth::user()->hasRole('ValidatorOpsis'))
        <li class="menu-header">Dashboard</li>
        <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
            <a class="nav-link" href="{{ route('dashboard.validopsis') }}">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.opsis') }}"><i class="fas fa-th-large"></i> <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="{{ Request::is('bebantrafo.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo.opsis') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang.opsis') }}"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel
                    Beban Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt.opsis') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI.opsis') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.opsis') }}"><i class="fas fa-th-large"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
        <li class="menu-header">Scada Fail</li>
        <li class="{{ Request::is('approval.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('approval.opsis') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Approval</span></a>
        </li>


    @elseif(Auth::user()->hasRole('ValidatorFasop'))
        <li class="menu-header">Dashboard</li>
        <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
            <a class="nav-link" href="{{ route('dashboard.validfasop') }}">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.validfasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.validfasop') }}"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>

        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="{{ Request::is('bebantrafo.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo.fasop') }}"><i class="fas fa-fw fa-boxes-alt"></i> <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang.fasop') }}"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel
                    Beban Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt.fasop') }}"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI.fasop') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('data.mvcell') }}"><i class="fas fa-th-large"></i> <span>Tabel
                            Data MVCELL</span></a>
                </li>
        </ul>



    @elseif(Auth::user()->hasRole('EditorOpsis'))
        <li class="menu-header">Dashboard</li>
        <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
            <a class="nav-link" href="{{ route('dashboard.editorop') }}">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.editorop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.editorop') }}"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="{{ Request::is('bebantrafo') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo') }}"><i class="fas fa-fw fa-boxes-alt"></i> <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang') }}"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>

        <li class="menu-header">Manajemen User</li>

        <li class='{{ Request::is('user.admin') ? 'active' : '' }}'>
            <a class="nav-link" href="{{ route('user.admin') }}"><i class="fas fa-user-alt"></i>User</a>
        </li>
        </li>
        </ul>
    @elseif(Auth::user()->hasRole('Visitor'))
        <li class="menu-header">Dashboard</li>
        <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
            <a class="nav-link" href="{{ route('dashboard.visitor') }}">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua') }}"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('trafo.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('trafo.visitor') }}"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel Beban Trafo</span></a>
        </li>
        <li class="{{ Request::is('penyulang.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penyulang.visitor') }}"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="{{ Request::is('ktt.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ktt.visitor') }}"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('GI.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('GI.visitor') }}"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.visitor') }}"><i class="fas fa-th-large"></i>
                <span>Tabel
                    Data MVCELL</span></a>
        </li>
        </ul>
        @endif




        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a class="btn btn-primary btn-lg btn-block btn-icon-split" href=""
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="fas fa-arrow-left"></i>{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout.post') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </aside>
</div>
