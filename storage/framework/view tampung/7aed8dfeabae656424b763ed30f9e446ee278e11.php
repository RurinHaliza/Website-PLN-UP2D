<div id="sidebar" class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">PLN UP2D Jatim</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">PLN</a>
        </div>
        <ul class="sidebar-menu">

            <?php if(Auth::user()->hasRole('Administrator')): ?>
                <li class="menu-header">Dashboard</li>
                <li class="<?php echo e(Request::is('Admin/Dashboard') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('dashboard.admin')); ?>"><i class="far fa-square"></i> <span>Main
                            Menu</span></a>
                </li>
                <li class="menu-header">Tabel Monitoring Beban</li>
                <li class="<?php echo e(Request::is('Admin/bebansemua') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('bebansemua')); ?>"><i class="fas fa-th-large"></i>
                        <span>Beban</span></a>
                </li>
                </li>
                <li class="menu-header">Tabel Beban</li>
                <li class="<?php echo e(Request::is('Admin/bebantrafo') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('bebantrafo')); ?>"><i class="fas fa-fw fa-boxes-alt"></i>
                        <span>Tabel Beban Trafo</span></a>
                </li>
                <li class="<?php echo e(Request::is('Admin/bebanpenyulang') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('bebanpenyulang')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                        <span>Tabel Beban Penyulang</span></a>
                </li>
                <li class="<?php echo e(Request::is('Admin/bebanktt') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('bebanktt')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                            KTT</span></a>
                </li>
                <li class="<?php echo e(Request::is('Admin/BebanGI') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('beban.GI')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                            Beban GI</span></a>
                </li>
                <li class="<?php echo e(Request::is('data.mvcell') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('data.mvcell')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                            Data MVCELL</span></a>
                </li>
                <li class="menu-header">Manajemen User</li>
                <li class="<?php echo e(Request::is('Admin/UserManagement') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('user.admin')); ?>"><i class="fas fa-user-alt"></i>
                        <span>User</span></a>
                </li>
        </ul>
    <?php elseif(Auth::user()->hasRole('operator')): ?>
        <li class="menu-header">Dashboard</li>
        <li class="<?php echo e(Request::is('Dashboard') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('dashboard.operator')); ?>"><i class="far fa-square"></i> <span>Main
                    Menu</span></a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="<?php echo e(Request::is('bebansemua.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebansemua.operator')); ?>"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        <li class="menu-header">Scada Fail</li>
        <li class="<?php echo e(Request::is('scadafail') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('scadafail')); ?>"><i class="fas fa-th-large"></i> <span>Input Scada
                    Fail</span></a>
        </li>
        </li>

        <li class="menu-header">Tabel Asset</li>
        <li class="<?php echo e(Request::is('trafo.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('trafo.operator')); ?>"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel Beban Trafo</span></a>
        </li>
        <li class="<?php echo e(Request::is('penyulang.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('penyulang.operator')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="<?php echo e(Request::is('ktt.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('ktt.operator')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="<?php echo e(Request::is('GI.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('GI.operator')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban GI</span></a>
        </li>
        <li class="<?php echo e(Request::is('data.mvcell.operator') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('data.mvcell.operator')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>

        
    <?php elseif(Auth::user()->hasRole('ValidatorOpsis')): ?>
        <li class="menu-header">Dashboard</li>
        <li class='<?php echo e(Request::is('dashboard-general-dashboard') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('dashboard.validopsis')); ?>">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="<?php echo e(Request::is('bebansemua.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebansemua.opsis')); ?>"><i class="fas fa-th-large"></i> <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="<?php echo e(Request::is('bebantrafo.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebantrafo.opsis')); ?>"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanpenyulang.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanpenyulang.opsis')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel
                    Beban Penyulang</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanktt') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanktt.opsis')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="<?php echo e(Request::is('beban.GI.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('beban.GI.opsis')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>
        <li class="<?php echo e(Request::is('data.mvcell.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('data.mvcell.opsis')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                    Data MVCELL</span></a>
        </li>
        <li class="menu-header">Scada Fail</li>
        <li class="<?php echo e(Request::is('approval.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('approval.opsis')); ?>"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Approval</span></a>
        </li>


    <?php elseif(Auth::user()->hasRole('ValidatorFasop')): ?>
        <li class="menu-header">Dashboard</li>
        <li class='<?php echo e(Request::is('dashboard-general-dashboard') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('dashboard.validfasop')); ?>">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="<?php echo e(Request::is('bebansemua.validfasop') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebansemua.validfasop')); ?>"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>

        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="<?php echo e(Request::is('bebantrafo') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebantrafo')); ?>"><i class="fas fa-fw fa-boxes-alt"></i> <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanpenyulang') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanpenyulang')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel
                    Beban Penyulang</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanktt.opsis') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanktt.opsis')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban
                    KTT</span></a>
        </li>
        <li class="<?php echo e(Request::is('beban.GI') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('beban.GI')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>
        <li class="<?php echo e(Request::is('data.mvcell') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('data.mvcell')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                            Data MVCELL</span></a>
                </li>

        <li class="menu-header">Manajemen User</li>

        <li class='<?php echo e(Request::is('user.admin') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('user.admin')); ?>"><i class="fas fa-user-alt"></i>User</a>
        </li>
        </li>
        </ul>



    <?php elseif(Auth::user()->hasRole('EditorOpsis')): ?>
        <li class="menu-header">Dashboard</li>
        <li class='<?php echo e(Request::is('dashboard-general-dashboard') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('dashboard.editorop')); ?>">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="<?php echo e(Request::is('bebansemua.editorop') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebansemua.editorop')); ?>"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Beban</li>
        <li class="<?php echo e(Request::is('bebantrafo') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebantrafo')); ?>"><i class="fas fa-fw fa-boxes-alt"></i> <span>Tabel
                    Beban Trafo</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanpenyulang') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanpenyulang')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="<?php echo e(Request::is('bebanktt') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebanktt')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="<?php echo e(Request::is('beban.GI') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('beban.GI')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    GI</span></a>
        </li>

        <li class="menu-header">Manajemen User</li>

        <li class='<?php echo e(Request::is('user.admin') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('user.admin')); ?>"><i class="fas fa-user-alt"></i>User</a>
        </li>
        </li>
        </ul>
    <?php elseif(Auth::user()->hasRole('Visitor')): ?>
        <li class="menu-header">Dashboard</li>
        <li class='<?php echo e(Request::is('dashboard-general-dashboard') ? 'active' : ''); ?>'>
            <a class="nav-link" href="<?php echo e(route('dashboard.visitor')); ?>">Main Menu</a>
        </li>
        <li class="menu-header">Tabel Monitoring Beban</li>
        <li class="<?php echo e(Request::is('bebansemua') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('bebansemua')); ?>"><i class="fas fa-th-large"></i>
                <span>Beban</span></a>
        </li>
        </li>
        <li class="menu-header">Tabel Asset</li>
        <li class="<?php echo e(Request::is('trafo.visitor') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('trafo.visitor')); ?>"><i class="fas fa-fw fa-boxes-alt"></i>
                <span>Tabel Beban Trafo</span></a>
        </li>
        <li class="<?php echo e(Request::is('penyulang.visitor') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('penyulang.visitor')); ?>"><i class="fas fa-fw fa-hourglass"></i>
                <span>Tabel Beban Penyulang</span></a>
        </li>
        <li class="<?php echo e(Request::is('ktt.visitor') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('ktt.visitor')); ?>"><i class="fas fa-th-large"></i> <span>Tabel Beban
                    KTT</span></a>
        </li>
        <li class="<?php echo e(Request::is('GI.visitor') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('GI.visitor')); ?>"><i class="fas fa-th-large"></i> <span>Tabel
                    Beban GI</span></a>
        </li>
        <li class="<?php echo e(Request::is('data.mvcell.visitor') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('data.mvcell.visitor')); ?>"><i class="fas fa-th-large"></i>
                <span>Tabel
                    Data MVCELL</span></a>
        </li>
        </ul>
        <?php endif; ?>




        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a class="btn btn-primary btn-lg btn-block btn-icon-split" href=""
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="fas fa-arrow-left"></i><?php echo e(__('Logout')); ?></a>
            <form id="logout-form" action="<?php echo e(route('logout.post')); ?>" method="POST" style="display: none;">
                <?php echo csrf_field(); ?>
            </form>

        </div>
    </aside>
</div>
<?php /**PATH C:\xampp\htdocs\MasterDataPLN2\resources\views/components/sidebar.blade.php ENDPATH**/ ?>