@php($langs = \Config::get('static_array.lang'))

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('web.dashboard') - MyYawik</title>

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
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/main.css') }}">

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
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLang" role="button" data-toggle="dropdown" aria-expanded="false">{{ $langs[app()->getLocale()] ?? 'English' }}</a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownLang">
                        @if($langs)
                            @foreach($langs as $ke => $lang )
                                <li><a class="dropdown-item {{ ($langs[app()->getLocale()] ?? 'English') == $lang ? 'bg-secondary' : '' }}" href="{{ route('changelang',$ke) }}">{{ $lang }}</a></li>
                            @endforeach
                        @endif
                    </ul>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">User Settings</span>
                        <div class="dropdown-divider"></div>
                        <a href=" {{ route('admin.profile') }} " class="dropdown-item">
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
            <a href="{{ route('home') }}" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MyYawik</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Admin Menu -->
                        <li class="nav-item">
                            <a href="{{ route('admin_dashboard') }}" class="nav-link @yield('admin_dashboard')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>@lang('web.dashboard')</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.talent_pool') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Talent-Pool</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.applications') }}" class="nav-link @yield('admin.application')">
                               <i class="nav-icon icofont-gear"></i>
                                <p>@lang('web.applications')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('adminjobs.index') }}" class="nav-link @yield('admin.admin_jobs')">
                                <i class="nav-icon icofont-search-job"></i>
                                <p>@lang('web.jobs')</p>
                            </a>
                        </li>
                        <li class="nav-item @yield('admin.web_settings')">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    @lang('web.web_settings')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.general_settings') }}" class="nav-link @yield('admin.general_settings')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.general_settings')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.email_templates') }}" class="nav-link @yield('admin.email_templates')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>E-Mail Templates</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.jobs') }}" class="nav-link @yield('admin.jobs')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.jobs')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jobcategories.index') }}" class="nav-link" @yield('jobcategories.index')>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.jobs_categories')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('professions.index') }}" class="nav-link @yield('profession.index')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Professions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('industry.index') }}" class="nav-link @yield('industry.index')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Industry</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users') }}" class="nav-link @yield('admin.users')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.users')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('orders.index') }}" class="nav-link @yield('orders.index')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.orders')</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item @yield('admin.organizations')">
                            <a href="#" class="nav-link">

                                <i class="nav-icon icofont-users-alt-2"></i>
                                <p>
                                    @lang('web.organizations')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.organization_overview') }}" class="nav-link @yield('admin.organization_overview')" >
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.overview')</p>
                                    </a>
                                </li>
                                 {{-- <li class="nav-item">
                                    <a href="{{ route('admin.organization_profile') }}" class="nav-link @yield('admin.organization_profile')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>profile</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('admin.organization_add') }}" class="nav-link @yield('admin.organization_add')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('web.insert')</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.resume') }}" class="nav-link @yield('admin.resume')">
                                <i class="nav-icon fas fa-file"></i>
                                <p>@lang('web.resume')</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{ route('admin.ideas') }}" class="nav-link @yield('admin.ideas')">
                                <i class="nav-icon icofont-unique-idea"></i>
                                <p>Ideas</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('admin.jobboard') }}" class="nav-link @yield('admin.job_board')">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>Jobboard</p>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you want to delete?",
            text: "This will be permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // document.getElementById("form").submit();
                window.location.href = link;
            }else {
                swal("Safe Data!")
            }
        });
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
