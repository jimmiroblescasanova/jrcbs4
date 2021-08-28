<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link d-flex justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{{ asset('logo_small.jpg') }}" alt="JRC Tecnología" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info text-white-50">
                Hola, <a href="#">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <x-partials.sidebar-nav-link :route="route('home')" :active="request()->routeIs('home')"
                    class="fas fa-home" title="Inicio" />

                @canany(['show companies', 'show contacts'])
                <li class="nav-header">CATALOGOS</li>
                @can('show companies')
                <x-partials.sidebar-nav-link :route="route('companies.index')"
                    :active="request()->routeIs('companies.*')" class="fas fa-building" title="Empresas" />
                @endcan
                @can('show contacts')
                <x-partials.sidebar-nav-link :route="route('contacts.index')" class="far fa-id-card"
                    :active="request()->routeIs('contacts.*')" title="Contactos" />
                @endcan
                @endcanany

                @canany(['show tickets', 'show mailings'])
                <li class="nav-header">MÓDULOS</li>
                @can('show tickets')
                <x-partials.sidebar-nav-link :route="route('tickets.index')" :active="request()->routeIs('tickets.*')"
                    class="fas fa-calendar-check">Tareas</x-partials.sidebar-nav-link>
                @endcan
                @can('show mailings')
                <x-partials.sidebar-nav-link :route="route('mailing.index')" :active="request()->routeIs('mailing.*')"
                    class="fas fa-envelope">Mailing</x-partials.sidebar-nav-link>
                @endcan
                @endcanany

                <x-partials.sidebar-nav-link :route="route('reports.index')" :active="request()->routeIs('reports.*')"
                    class="fas fa-poll">Reportes</x-partials.sidebar-nav-link>

                @canany(['show users', 'show activities', 'show tags', 'show groups', 'edit hosts'])
                <li class="nav-header">OTROS</li>
                @can('show users')
                <x-partials.sidebar-nav-link :route="route('users.index')" :active="request()->routeIs('users.*')"
                    class="fas fa-users" title="Usuarios" />
                @endcan
                @canany(['show activities', 'show tags', 'show groups', 'edit hosts'])
                <x-partials.sidebar-nav-link :route="route('configurations.index')"
                    :active="request()->routeIs('configurations.*')" class="fas fa-cog" title="Configuraciones" />
                @endcanany
                @endcanany

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
