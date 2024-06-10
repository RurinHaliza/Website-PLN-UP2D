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
                    <a class="nav-link" href="{{ route('dashboard.admin') }}"><i class="fa fa-compass"></i> <span>Main
                            Menu</span></a>
                </li>
                <li class="menu-header">Tabel Monitoring Beban</li>
                <li class="{{ Request::is('Admin/bebansemua') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebansemua') }}"><i class="fa fa-line-chart"></i>
                        <span>Beban</span></a>
                </li>
                </li>
                <li class="menu-header">Scada Fail</li>
                <li class="{{ Request::is('scadafail.admin') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('scadafail.admin') }}"><i class="fa fa-exclamation-triangle"></i>
                        <span>Input Scada
                            Fail</span></a>

                <li class="{{ Request::is('approval') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('approval') }}"><i class="fa fa-check-square"></i>
                        <span>Approval</span></a>
                </li>
                </li>
                <li class="menu-header">Tabel Asset</li>
                <li class="{{ Request::is('dataform.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dataform.index') }}"><i class="fa fa-database"></i>
                        <span>Tabel Data Form Bulanan</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebantrafo') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebantrafo') }}"><i class="fa fa-microchip"></i>
                        <span>Tabel Trafo</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebanpenyulang') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebanpenyulang') }}"><i class="fa fa-cog"></i>
                        <span>Tabel Penyulang</span></a>
                </li>
                <li class="{{ Request::is('Admin/bebanktt') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('bebanktt') }}"><i class="fa fa-bolt"></i> <span>Tabel
                            KTT</span></a>
                </li>
                <li class="{{ Request::is('Admin/BebanGI') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('beban.GI') }}"><i class="fa fa-university"></i> <span>Tabel
                            GI</span></a>
                </li>
                <li class="{{ Request::is('data.mvcell') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('data.mvcell') }}"><i class="fa fa-cogs"></i> <span>Tabel
                            Data MVCELL</span></a>
                </li>
                <li class="menu-header">Manajemen User</li>
                <li class="{{ Request::is('Admin/UserManagement') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.admin') }}"><i class="fa fa-address-card"></i>
                        <span>User</span></a>
                </li>
        </ul>
    @elseif(Auth::user()->hasRole('operator'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.operator') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.operator') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        <li class="menu-header">Scada Fail</li>
        <li class="{{ Request::is('scadafail') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('scadafail') }}"><i class="fa fa-exclamation-triangle"></i> <span>Input
                    Scada
                    Fail</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('trafo.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('trafo.operator') }}"><i class="fa fa-microchip"></i>
                <span>Tabel Trafo</span></a>
        </li>
        <li class="{{ Request::is('penyulang.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penyulang.operator') }}"><i class="fa fa-cog"></i>
                <span>Tabel Penyulang</span></a>
        </li>
        <li class="{{ Request::is('ktt.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ktt.operator') }}"><i class="fa fa-bolt"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('GI.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('GI.operator') }}"><i class="fa fa-university"></i> <span>Tabel
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.operator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.operator') }}"><i class="fa fa-cogs"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
    @elseif(Auth::user()->hasRole('ValidatorOpsis'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.validopsis') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.opsis') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        </li>

        <li class="menu-header">Scada Fail</li>
        <li class="{{ Request::is('approval') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('approval') }}"><i class="fa fa-check-square"></i>
                <span>Approval</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('dataform.index.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataform.index.opsis') }}"><i class="fa fa-database"></i>
                <span>Tabel Data Form Bulanan</span></a>
        </li>

        <li class="{{ Request::is('bebantrafo.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo.opsis') }}"><i class="fa fa-microchip"></i>
                <span>Tabel
                    Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang.opsis') }}"><i class="fa fa-cog"></i>
                <span>Tabel
                    Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt.opsis') }}"><i class="fa fa-bolt"></i> <span>Tabel
                    Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI.opsis') }}"><i class="fa fa-university"></i> <span>Tabel
                    Beban
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.opsis') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.opsis') }}"><i class="fa fa-cogs"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
    @elseif(Auth::user()->hasRole('ValidatorFasop'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.validfasop') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.validfasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.validfasop') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        <li class="menu-header">Approval</li>
        <li class="{{ Request::is('approval') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('approval') }}"><i class="fa fa-check-square"></i>
                <span>Approval</span></a>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('dataform.index.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataform.index.fasop') }}"><i class="fa fa-database"></i>
                <span>Tabel Data Form Bulanan</span></a>
        </li>
        </li>
        <li class="{{ Request::is('bebantrafo.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo.fasop') }}"><i class="fa fa-microchip"></i>
                <span>Tabel
                    Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang.fasop') }}"><i class="fa fa-cog"></i>
                <span>Tabel
                    Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt.fasop') }}"><i class="fa fa-bolt"></i> <span>Tabel
                    Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI.fasop') }}"><i class="fa fa-university"></i> <span>Tabel
                    Beban
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.fasop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.fasop') }}"><i class="fa fa-cogs"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
        </ul>
    @elseif(Auth::user()->hasRole('EditorOpsis'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.editorop') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.editorop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.editorop') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('dataform.index.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataform.index.edops') }}"><i class="fa fa-database"></i>
                <span>Tabel Data Form Bulanan</span></a>
        </li>
        </li>
        <li class="{{ Request::is('bebantrafo.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebantrafo.edops') }}"><i class="fa fa-microchip"></i> <span>Tabel
                    Trafo</span></a>
        </li>
        <li class="{{ Request::is('bebanpenyulang.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanpenyulang.edops') }}"><i class="fa fa-cog"></i>
                <span>Tabel Penyulang</span></a>
        </li>
        <li class="{{ Request::is('bebanktt.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebanktt.edops') }}"><i class="fa fa-bolt"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('beban.GI.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('beban.GI.edops') }}"><i class="fa fa-university"></i> <span>Tabel Beban
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.edops') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.edops') }}"><i class="fa fa-cogs"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
        </ul>
    @elseif(Auth::user()->hasRole('Visitor'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('dashboard.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.visitor') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.visitor') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('dataform.index.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataform.index.visitor') }}"><i class="fa fa-database"></i>
                <span>Tabel Data Form Bulanan</span></a>
        </li>
        </li>

        <li class="{{ Request::is('trafo.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('trafo.visitor') }}"><i class="fa fa-microchip"></i>
                <span>Tabel Trafo</span></a>
        </li>
        <li class="{{ Request::is('penyulang.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('penyulang.visitor') }}"><i class="fa fa-cog"></i>
                <span>Tabel Penyulang</span></a>
        </li>
        <li class="{{ Request::is('ktt.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('ktt.visitor') }}"><i class="fa fa-bolt"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('GI.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('GI.visitor') }}"><i class="fa fa-university"></i> <span>Tabel
                    GI</span></a>
        </li>
        <li class="{{ Request::is('data.mvcell.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data.mvcell.visitor') }}"><i class="fa fa-cogs"></i>
                <span>Tabel
                    Data MVCELL</span></a>
        </li>
        </ul>
    @elseif(Auth::user()->hasRole('Manager'))
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.manager') }}"><i class="fa fa-compass"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="{{ Request::is('bebansemua.manager') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bebansemua.manager') }}"><i class="fa fa-line-chart"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="{{ Request::is('dataform.index.manager') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dataform.index.manager') }}"><i class="fa fa-database"></i>
                <span>Tabel Data Form Bulanan</span></a>
        </li>
        </li>

        <li class="{{ Request::is('trafo.visitor') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('trafo.manager') }}"><i class="fa fa-microchip"></i>
                <span>Tabel Trafo</span></a>
        </li>
        <li class="{{ Request::is('manager.penyulang') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('manager.penyulang') }}"><i class="fa fa-cog"></i>
                <span>Tabel Penyulang</span></a>
        </li>
        <li class="{{ Request::is('manager.ktt') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('manager.ktt') }}"><i class="fa fa-bolt"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="{{ Request::is('manager.gi') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('manager.gi') }}"><i class="fa fa-university"></i> <span>Tabel
                    GI</span></a>
        </li>
        <li class="{{ Request::is('mvcell.manager') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('mvcell.manager') }}"><i class="fa fa-cogs"></i>
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
