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
                        <input type="checkbox" id="todoCheckbox{{ $key }}" wire:click='checkReminder({{ $reminder->id }})' {{ ($reminder->done) ? 'checked' : '' }}>
                        <label for="todoCheckbox{{ $key }}"></label>
                    </div>
                    <span class="text">{{ $reminder->title }}</span>
                    <small
                        class="badge {{ $reminder->due_date > NOW() ? 'badge-primary' : 'badge-danger' }}"><i
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
        <button type="button" id="addReminderBtn" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i>
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
