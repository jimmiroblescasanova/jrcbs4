<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-id-badge mr-2"></i>Contactos</h1>
        </div>
        @can('create contacts')
            <div class="col-sm-6">
                <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-pencil-alt mr-2" aria-hidden="true"></i>Nuevo</a>
            </div>
        @endcan
    </x-slot>

    @livewire('contacts.show-contacts-table')

</x-main-layout>
