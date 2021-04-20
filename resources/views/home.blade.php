<x-main-layout>
    <x-slot name="header">
        <h1><i class="fas fa-home mr-2"></i>Inicio</h1>
    </x-slot>

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Titulo del card</h3>
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
        </div>
        <div class="col-3">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-calendar-check mr-2"></i>Tickets pendientes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($tickets as $ticket)
                            <li class="item">
                                <div class="product-img">
                                    <img src="https://ui-avatars.com/api/?name={{ $ticket->contact->name }}" alt="{{ $ticket->contact->name }}" class="img-size-50 rounded-circle">
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="product-title">{{ $ticket->activity->name }}
                                        {{-- <span class="badge float-right text-light" style="background-color:{{ $ticket->tag->color }};">{{ $ticket->tag->name }}</span> --}}
                                    </a>
                                    <span class="float-right text-xs">{{ $ticket->created_at->diffForHumans() }}</span>
                                    <span class="product-description">
                                        {{ Str::limit($ticket->note, 25, '...') }}
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="{{ route('tickets.index') }}" class="uppercase">Ver todos</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</x-main-layout>
