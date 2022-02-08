<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('head')
    <link rel="icon" type="image/png" href="{{ URL::asset('/silegon/img/logofkip.png') }}">
    <title>SILEGON FKIP UKSW</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
        integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link href="{{ URL::asset('/silegon/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{ URL::asset('/silegon/img/logofkip.png') }}" width="50px"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SILEGON FKIP</div>
            </a>

            @if (Auth::user()->role == '1')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dataadmin') }}">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span>Data Admin</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dataalumni') }}">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span>Data Alumni</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dataprodi') }}">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span>Data Program Studi</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('password') }}">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Ganti Password</span></a>
                </li>

            @elseif(Auth::user()->role == '2')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('validasiberkas') }}">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Validasi</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permintaan') }}">
                        <i class="fas fa-fw fa-paste"></i>
                        <span>Pemesanan Legalisir</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('password') }}">
                        <i class="fas fa-fw fa-key"></i>
                        <span>Ganti Password</span></a>
                </li>
            @elseif(Auth::user()->role == '3')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('daftarberkas') }}">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Daftar Berkas</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permintaanlegalisir') }}">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Permintaan Legalisir</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profil') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Profil</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pemesanan') }}">
                        <i class="fas fa-fw fa-envelope"></i>
                        <span>Pemesanan</span></a>
                </li>
            @endif

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('php')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; SILEGON FKIP UKSW</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anda ingin Logout ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('/silegon/vendor/jquery/jquery.min.js') }}"></script>
    <script src="/../../silegon/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('/silegon/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('/silegon/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ URL::asset('/silegon/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/silegon/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        });
    </script>
    @yield('javascript')
</body>

</html>
