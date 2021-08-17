<x-main-layout>
    <x-slot name="header">
        <h1><i class="fas fa-home mr-2"></i>Inicio</h1>
    </x-slot>

    <div class="row">
        <div class="col-9">
            @livewire('reminders')

        </div>
        <div class="col-3">
            <div class="card card-danger card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="far fa-calendar-check mr-2"></i>Tareas pendientes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($tickets as $ticket)
                            <li class="item">
                                <div class="product-img">
                                    <img src="https://ui-avatars.com/api/?name={{ $ticket->contact->name }}"
                                        alt="{{ $ticket->contact->name }}" class="img-size-50 rounded-circle">
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="product-title">{{ $ticket->activity->name }}
                                    </a>
                                    <span
                                        class="float-right text-xs">{{ $ticket->created_at->diffForHumans() }}</span>
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

    <x-slot name="custom_scripts">
        <script>
            $('.datepicker').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                titleFormat: "MM yyyy",
                language: 'es',
                startDate: 'today',
                todayBtn: 'linked',
                todayHighlight: true,
                daysOfWeekDisabled: [0],
                disableTouchKeyboard: true,
            });

            $('#addReminderBtn').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('#addReminderForm').removeClass('d-none');
            });
        </script>
    </x-slot>

</x-main-layout>
