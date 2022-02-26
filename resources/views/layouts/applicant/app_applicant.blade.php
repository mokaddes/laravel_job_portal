<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - MyYawik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/main.css') }}">
    @stack('header_script')
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">


        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                @php
                    $langs = \Config::get('static_array.lang');
                @endphp

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >{{ $langs[app()->getLocale()] ?? 'Enlish' }}</a>

                    <ul class="dropdown-menu" >
                        @if($langs)
                            @foreach($langs as $ke => $lang )
                                <li><a class="dropdown-item" href="{{ route('changelang',$ke) }}">{{ $lang }}</a></li>
                            @endforeach
                        @endif
                    </ul>

                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"> {{ Auth::user()->name }} </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">User Settings</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('applicant.profile') }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>@lang('web.profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             <i class="fas fa-sign-out-alt"></i> @lang('web.logout')
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <span class="brand-text font-weight-light">MyYawik</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('applicant_dashboard') }}" class="nav-link @yield('applicant.dashboard')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>@lang('web.dashboard')</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('applicant.talent_pool') }}" class="nav-link @yield('applicant.talent_pool')">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Talent-Pool</p>
                            </a>
                        </li>  --}}
                        <li class="nav-item">
                            <a href="{{ route('applicant.resume') }}" class="nav-link @yield('applicant.resume')" >
                                <i class="nav-icon fas fa-edit"></i>
                                <p>@lang('web.resume')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applicant.applications') }}" class="nav-link @yield('applicant.applications')">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>@lang('web.applications')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applicant.jobboard') }}" class="nav-link  @yield('applicant.jobboard')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Jobboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applicant.ideas') }}" class="nav-link @yield('applicant.ideas')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>Ideas</p>
                            </a>
                        </li>
                   </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <main class="">
            @yield('content')
        </main>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script>
        $(function(){
          'use strict';

          $('#datatable1').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
            }
          });

          $('#datatable2').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
          });

          // Select2
          $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        });
    </script>
        @stack('footer_script')
</body>

</html>
</html>
