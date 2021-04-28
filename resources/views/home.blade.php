<x-main-layout>
    <x-slot name="header">
        <h1><i class="fas fa-home mr-2"></i>Inicio</h1>
    </x-slot>

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-check-double mr-2"></i>
                        Recordatorios
                    </h3>
                    {{-- <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item"><a href="#" class="page-link">«</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">»</a></li>
                        </ul>
                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="todo-list" id="my-todo-list" data-widget="todo-list">
                        @foreach ($reminders as $key => $reminder)
                            <li>
                                <div class="icheck-primary d-inline ml-2">
                                    <input
                                        type="checkbox"
                                        id="todoCheckbox{{ $key }}"
                                        {{ $reminder->done ? 'checked' : '' }}
                                    />
                                    <label for="todoCheckbox{{ $key }}"></label>
                                </div>
                                <span class="text">{{ $reminder->title }}</span>
                                <small class="badge {{ $reminder->due_date > NOW() ? 'badge-primary' : 'badge-danger' }}"><i
                                        class="far fa-clock mr-1"></i>{{ $reminder->due_date->diffForHumans() }}</small>
                                <div class="tools">
                                    <i class="fas fa-trash-alt"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" id="addReminderBtn" class="btn btn-primary btn-sm float-right"><i
                            class="fas fa-plus"></i>
                        Add item</button>
                    <form id="addReminderForm" wire:submit.prevent='save' class="d-none">
                        <div class="form-row">
                            <div class="form-group col-md-8 mb-0">
                                <label for="reminderTitle" class="sr-only">Nuevo recordatorio</label>
                                <input type="text" wire:model.defer='reminderTitle' class="form-control form-control-sm"
                                    id="reminderTitle" placeholder="Agregar recordatorio">
                            </div>
                            <div class="form-group col-md-2 mb-0">
                                <label for="reminderDueDate" class="sr-only">Fecha</label>
                                <input type="text" wire:model.defer='reminderDueDate'
                                    class="form-control form-control-sm datetimepicker-input" id="reminderDueDate"
                                    data-toggle="datetimepicker" data-target="#reminderDueDate" />
                            </div>
                            <div class="form-group col-md-2 mb-0">
                                <button type="submit" class="btn btn-primary btn-sm btn-block"> <i
                                        class="fas fa-save mr-2"></i>Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
        {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script> --}}
        <script>
            $(function() {
                $('#reminderDueDate').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'es-mx'
                });
            });

            $('#addReminderBtn').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('#addReminderForm').removeClass('d-none');
            });

            /* $('#my-todo-list').TodoList({
                onCheck: function(checkbox) {
                    // Do something when the checkbox is checked
                },
                onUnCheck: function(checkbox) {
                    // Do something after the checkbox has been unchecked
                }
            }); */

        </script>
    </x-slot>

</x-main-layout>
