<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icheck-bootstrap@3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <x-layout.navbar />
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <x-layout.sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <h1><i class="fas fa-home mr-2"></i>Configuraciones</h1>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tablas</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('configurations.index') }}"
                                            class="nav-link {{ setActive('configurations.index') }}">
                                            <i class="fas fa-key mr-2"></i>Hosts
                                        </a>
                                    </li>
                                    @can('show groups')
                                    <li class="nav-item">
                                        <a href="{{ route('configurations.groups.index') }}"
                                            class="nav-link {{ setActive('configurations.groups.*') }}">
                                            <i class="fas fa-user-lock mr-2"></i>Grupos
                                        </a>
                                    </li>
                                    @endcan
                                    @can('show activities')
                                    <li class="nav-item">
                                        <a href="{{ route('configurations.activities.index') }}"
                                            class="nav-link {{ setActive('configurations.activities.*') }}">
                                            <i class="fas fa-clipboard-list mr-2"></i>Actividades
                                        </a>
                                    </li>
                                    @endcan
                                    @can('show tags')
                                    <li class="nav-item">
                                        <a href="{{ route('configurations.tags.index') }}"
                                            class="nav-link {{ setActive('configurations.tags.*') }}">
                                            <i class="fas fa-tags mr-2"></i>Etiquetas
                                        </a>
                                    </li>
                                    @endcan
                                    @can('show programs')
                                    <li class="nav-item">
                                        <a href="{{ route('configurations.programs.index') }}"
                                            class="nav-link {{ setActive('configurations.programs.*') }}">
                                            <i class="fas fa-hdd mr-2"></i>Programas
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (session()->has('success'))
                        <x-partials.alert type="success" icon="fas fa-check" :message="session('message')" />
                        @endif

                        @yield('content')
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <x-layout.footer />

    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.es.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    @yield('myScripts')
</body>

</html>
