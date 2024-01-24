<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My PKM</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/logo.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
    
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="/index.html" class="text-nowrap logo-img">
                        <!-- <img src="/assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
                        <h2 class="fw-bold">My PKM </h2>
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap ">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link <?= ($page_title == 'dashboard') ? 'active' : '' ?>" href="/mahasiswa/dashboard" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Akun</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link <?= ($page_title == 'akun') ? 'active' : '' ?>" href="/mahasiswa/profile" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">Profil</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">My PKM</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link <?= ($page_title == 'usulan') ? 'active' : '' ?>" href="/mahasiswa/usulan" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file"></i>
                                </span>
                                <span class="hide-menu">Data Usulan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link <?= ($page_title == 'buku_panduan') ? 'active google-drive-link' : 'google-drive-link' ?>" href="https://drive.google.com/drive/folders/1qm6SPJ6_qtNlnFomI9gqURPz7hs6y2Bs" target="_blank" aria-expanded="false">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Buku Panduan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                                <a class="sidebar-link <?= ($page_title == 'about') ? 'active' : '' ?>" href="/mahasiswa/about" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-help"></i>
                                    </span>
                                    <span class="hide-menu">About</span>
                                </a>
                            </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <p class="fw-bold btn btn-primary mx-3 mt-2 d-block"><?= session('user')['nama'] ?></p>
                                        <a href="/login/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <?= $this->renderSection('content') ?>

            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by PUM 2023</p>
            </div>
        </div>
    </div>
    </div>
    <script>
        let table = new DataTable('#table', {
            responsive: true
        });
    </script>
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script> 
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/sidebarmenu.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="/assets/js/dashboard.js"></script>
</body>

</html>