<x-main-layout>
    <x-slot name="header">
        <h1><i class="fas fa-poll mr-2"></i>Reportes</h1>
    </x-slot>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <i class="far fa-building mr-2"></i>Empresas
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm table-striped">
                        <tbody>
                        <tr>
                            <td>
                                <a target="_blank" href="{{ route('reports.companies-contacts') }}"><i
                                        class="fas fa-search mr-2"></i>Relación de empresas y contactos</a>
                            </td>
                            <td class="text-right">
                                <a href="#" tabindex="0" data-toggle="popover" data-trigger="focus"
                                   data-content="Muestra un listado de las empresas con los contactos asociados y la información de cada uno."><i
                                        class="fas fa-question-circle fa-xs"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a target="_blank" href="{{ route('reports.companies-programs') }}"><i
                                        class="fas fa-search mr-2"></i>Relación de
                                    empresas y programas</a>
                            </td>
                            <td class="text-right">
                                <a href="#" tabindex="0" data-toggle="popover" data-trigger="focus"
                                   data-content="Muestra un listado de las empresas con los programas que tiene cada una."><i
                                        class="fas fa-question-circle fa-xs"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Text</p>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
    </div>

    <x-slot name="custom_scripts">
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover();
            });
            $('.popover-dismiss').popover({
                trigger: 'focus'
            });
        </script>
    </x-slot>

</x-main-layout>
