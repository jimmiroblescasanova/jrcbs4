<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link d-flex justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="brand-link">
            <img src="https://via.placeholder.com/150" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="https://via.placeholder.com/150" class="img-circle elevation-2" alt="User Image">
            </div> --}}
            <div class="info text-white-50">
                Hola, <a href="#">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar menú" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <x-partials.sidebar-nav-link
                    :route="route('home')"
                    :active="request()->routeIs('home')"
                    class="fas fa-home"
                    message="Inicio"
                />
                <x-partials.sidebar-nav-link :route="route('companies.index')" :active="request()->routeIs('companies.*')" class="fas fa-building" message="Empresas" />
                <x-partials.sidebar-nav-link :route="route('contacts.index')" class="fas fa-users" :active="request()->routeIs('contacts.*')" message="Contactos" />
                <x-partials.sidebar-nav-link :route="route('tickets.index')" :active="request()->routeIs('tickets.*')" class="fas fa-calendar-check" message="Tickets" />
                <x-partials.sidebar-nav-link :route="route('configurations.index')" :active="request()->routeIs('configurations.*')" class="fas fa-cog" message="Configuraciones" />

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Inicio
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <x-partials.sidebar-nav-link class="far fa-circle" message="Test Contacts" />
                        <li class="nav-item">
                            <a href="../../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../search/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../search/enhanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Cerrar sesión</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!-- /.sidebar -->
</aside>
