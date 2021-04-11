<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1>Tickets</h1>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</a>
        </div>
    </x-slot>

    @livewire('tickets.show-tickets-table')

</x-main-layout>
