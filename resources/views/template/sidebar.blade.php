@php
    $currentURL = request()->url();
@endphp
<!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
                <div class="sidebar-brand-text mx-3">Sahabat Alam</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $currentURL == 'http://127.0.0.1:8000/admin/dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Utama
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Siswa</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Status Siswa:</h6>
                        <a class="collapse-item" href="{{ route('students.inschool') }}">Masih Sekolah</a>
                        @if (Auth::user()->hasRole('admin'))
                        <a class="collapse-item" href="{{ route('students.graduated') }}">Sudah Lulus</a>
                        @endif
                    </div>
                </div>
            </li>
            @if (Auth::user()->hasRole('admin'))
                <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="/students/graduate">
                    <i class="fas fa-fw fa-angle-double-up"></i>
                    <span>Proses Siswa Lulus dan Naik Kelas</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/students/pendaftaran-siswa-sd">
                    <i class="fas fa-fw fa-angle-double-up"></i>
                    <span>Proses Siswa Baru</span></a>
            </li>
            @endif
            
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->