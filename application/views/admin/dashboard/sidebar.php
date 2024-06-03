<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">CV Kharisma Gina Dental Lab</div>
            </a>
            <hr class="sidebar-divider my-0">         
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo site_url('auth/dashboard')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('auth/tampil_karyawan')?>" >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Karyawan</span>
                </a>   
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('auth/tampil_kriteria')?>" >
                <i class="fas fa-fw fa-chart-area"></i>
                    <span>Kriteria</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?php echo site_url('auth/tampil_matrix')?>" >
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Matrix Penilaian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#perhitunganAHP"
                    aria-expanded="true" aria-controls="perhitunganAHP">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Perhitungan AHP</span>
                </a>
                <div id="perhitunganAHP" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rincian Perhitungan:</h6>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilPerbandingan')?>">Perbandingan</a>
                        <!-- <a class="collapse-item" href="<?php echo site_url('auth/tampilIdeal')?>">Titik Ideal</a>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilJarakKaryawan')?>">Jarak Ideal </a>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilNilaiPreferensiDanPeringkat')?>">Preferensi dan Peringkat </a> -->
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#perhitunganTOPSIS"
                    aria-expanded="true" aria-controls="perhitunganTOPSIS">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Perhitungan Topsis</span>
                </a>
                <div id="perhitunganTOPSIS" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Rincian Perhitungan:</h6>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilHasil')?>">Normalisasi</a>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilIdeal')?>">Titik Ideal</a>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilJarakKaryawan')?>">Jarak Ideal </a>
                        <a class="collapse-item" href="<?php echo site_url('auth/tampilNilaiPreferensiDanPeringkat')?>">Preferensi dan Peringkat </a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="ml-auto">
                <a href="<?php echo site_url('auth/logout'); ?>" ><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>Logout</a>

                </div>
            </nav>

            
            