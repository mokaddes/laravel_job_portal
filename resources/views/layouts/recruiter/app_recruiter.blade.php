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
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> --}}
    <!-- Theme style -->
    @stack('header_script')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/main.css') }}">
    <style>
        .alert-primary {
            color: #004085;
            background-color: #cce5ff;
            border-color: #b8daff;
        }

        .nav-item.active .nav-treeview{display: block }

    </style>
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
            {{-- Lang --}}
            @php
                $langs = \Config::get('static_array.lang');
            @endphp

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >{{ $langs[app()->getLocale()] ?? 'Enlish' }}</a>

                <ul class="dropdown-menu" >
                    @if($langs)
                        @foreach($langs as $ke => $lang )
                            <li><a class="dropdown-item {{ ($langs[app()->getLocale()] ?? 'English') == $lang ? 'bg-secondary' : '' }}" href="{{ route('changelang',$ke) }}">{{ $lang }}</a></li>
                        @endforeach
                    @endif
                </ul>

            </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i> {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">User Settings</span>
                        <div class="dropdown-divider"></div>
                        <a href=" {{route('recruiter.profile')}} " class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>Profile
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
            <a href="{{ route('recruiter_dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MyYawik</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Admin Menu -->
                        <li class="nav-item">
                            <a href="{{ route('recruiter_dashboard') }}" class="nav-link @yield('recruiter.dashboard') ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>@lang('web.dashboard')</p>
                            </a>
                        </li>
                         {{-- <li class="nav-item">
                            <a href="{{ route('recruiter.talent_pool') }}" class="nav-link @yield('recruiter.talent_pool')">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Talent-Pool</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('recruiter.applications') }}" class="nav-link @yield('recruiter.applications')">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>@lang('web.applications')</p>
                            </a>
                        </li>
                        <li class="nav-item @yield('recruiter.jobs')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                     @lang('web.jobs')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.jobs') }}" class="nav-link @yield('recruiter.jobs_overview')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.overview')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.jobs_create') }}" class="nav-link @yield('recruiter.jobs_create')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.create')</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('recruiter.organizations')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    @lang('web.organizations')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.organization_overview') }}" class="nav-link @yield('recruiter.organization_overview')" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.overview')</p>
                                    </a>
                                </li>
                                 {{-- <li class="nav-item">
                                    <a href="{{ route('recruiter.organization_profile') }}" class="nav-link @yield('recruiter.organization_profile')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>profile</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.organization_add') }}" class="nav-link @yield('recruiter.organization_add')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.insert')</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('recruiter.settings')">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    @lang('web.settings')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" >
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.email_templates') }}" class="nav-link @yield('recruiter.email_templates')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>E-mail Templates</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.general_setting') }}" class="nav-link @yield('recruiter.general_setting')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.general_settings')</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link @yield('recruiter.orders')">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>@lang('web.orders')</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.oder.view') }}" class="nav-link @yield('recruiter.orders')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.overview')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('recruiter.orders') }}" class="nav-link @yield('recruiter.order_view')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.create')</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
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
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    @stack('footer_script')
    <script>
            $(function () {
              $('.select2').select2()
              $('.select3').select2()
            });
    </script>

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
</body>

</html>
</html>
