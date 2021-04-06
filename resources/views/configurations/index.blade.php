<x-main-layout>
    <x-slot name="header">
        <h1>Configuraciones del sistema</h1>
    </x-slot>

    @livewire('configurations.change-hosts')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Titulo del card 2</h3>
        </div>
        <div class="card-body">
            Start creating your amazing application!
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
</x-main-layout>
