<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">AT Payment</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ $menuActive == null ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'superuser')
                    <li class="nav-header">Super Admin</li>
                    <li class="nav-item">
                        <a href="{{ route('atp.karyawan') }}"
                            class="nav-link {{ $menuActive == 'karyawan' ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <p>
                                Master Karyawan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.modul') }}"
                            class="nav-link {{ $menuActive == 'modul' ? 'active' : '' }}">
                            <i class="fas fa-building nav-icon"></i>
                            <p>
                                Data Modul
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('atp.bank') }}" class="nav-link {{ $menuActive == 'bank' ? 'active' : '' }}">
                            <i class="fas fa-university nav-icon"></i>
                            <p>
                                Data Bank
                            </p>
                        </a>
                    </li>
                    <li class="nav-item {{ $menuOpen == 'audit' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $menuOpen == 'audit' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-donate"></i>
                            <p>
                                Master Audit
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('atp.audit.main') }}"
                                    class="nav-link {{ $menuActive == 'mainaudit' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Main Audit</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('atp.audit.pengeluaran') }}"
                                    class="nav-link {{ $menuActive == 'auditpengeluaran' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Audit Pengeluaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('atp.audit.pemasukan') }}"
                                    class="nav-link {{ $menuActive == 'auditpemasukan' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Audit Pemasukan</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="{{ route('atp.deposit.otomax') }}"
                            class="nav-link {{ $menuActive == 'otomax' ? 'active' : '' }}">
                            <i class="fas fa-cash-register nav-icon"></i>
                            <p>
                                Deposit Reseller
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.monitoring.deposit') }}"
                            class="nav-link {{ $menuActive == 'monitorsaldo' ? 'active' : '' }}">
                            <i class="fas fa-vote-yea nav-icon"></i>
                            <p>
                                Monitoring Deposit
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Karyawan</li>
                    <li class="nav-item">
                        <a href="{{ route('atp.mutasi') }}"
                            class="nav-link {{ $menuActive == 'mutasi' ? 'active' : '' }}">
                            <i class="fas fa-credit-card nav-icon"></i>
                            <p>
                                Data Mutasi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.modul.mutasi') }}"
                            class="nav-link {{ $menuActive == 'modulMutasi' ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave nav-icon"></i>
                            <p>
                                Monitor Modul
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.deposit.kredit') }}"
                            class="nav-link {{ $menuActive == 'kredit' ? 'active' : '' }}">
                            <i class="fas fa-receipt nav-icon"></i>
                            <p>
                                Input Deposit / Kredit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.req') }}" class="nav-link {{ $menuActive == 'tiket' ? 'active' : '' }}">
                            <i class="fas fas fa-ticket-alt nav-icon"></i>
                            <p>
                                Request Tiket
                            </p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'karyawan')
                    <li class="nav-header">Karyawan</li>
                    <li class="nav-item">
                        <a href="{{ route('atp.mutasi') }}"
                            class="nav-link {{ $menuActive == 'mutasi' ? 'active' : '' }}">
                            <i class="fas fa-credit-card nav-icon"></i>
                            <p>
                                Data Mutasi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.modul.mutasi') }}"
                            class="nav-link {{ $menuActive == 'modulMutasi' ? 'active' : '' }}">
                            <i class="fas fa-money-bill-wave nav-icon"></i>
                            <p>
                                Monitor Modul
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.deposit.kredit') }}"
                            class="nav-link {{ $menuActive == 'kredit' ? 'active' : '' }}">
                            <i class="fas fa-receipt nav-icon"></i>
                            <p>
                                Input Deposit / Kredit
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('atp.req') }}" class="nav-link {{ $menuActive == 'tiket' ? 'active' : '' }}">
                            <i class="fas fas fa-ticket-alt nav-icon"></i>
                            <p>
                                Request Tiket
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">Pengaturan</li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ $menuActive == 'ganti-password' ? 'active' : '' }}">
                        <i class="fas fa-key nav-icon"></i>
                        <p>
                            Ubah Password
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                        </form>
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
