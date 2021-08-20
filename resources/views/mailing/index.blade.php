<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-envelope mr-2"></i>Enviar correo masivo</h1>
        </div>
        <div class="col-sm-6">
            <div class="btn-group float-right">
                <a href="{{ route('mailing.create') }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                    data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                    <a class="dropdown-item" href="#"><i class="fas fa-download mr-2"></i>Exportar excel</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-print mr-2"></i>Imprimir</a>
                </div>
            </div>
        </div>
    </x-slot>

</x-main-layout>
