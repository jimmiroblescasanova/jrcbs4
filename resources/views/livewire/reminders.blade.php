<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-check-double mr-2"></i>
            Recordatorios
        </h3>
        <div class="card-tools">
            {{ $reminders->links() }}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <ul class="todo-list">
            @foreach ($reminders as $key => $reminder)
                <li class="{{ ($reminder->done) ? 'done' : '' }}">
                    <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" id="todoCheckbox{{ $key }}" wire:click='checkReminder({{ $reminder->id }})' {{ ($reminder->done) ? 'checked' : '' }}>
                        <label for="todoCheckbox{{ $key }}"></label>
                    </div>
                    <span class="text">{{ $reminder->title }}</span>
                    <small
                        class="badge {{ $reminder->due_date > NOW() ? 'badge-primary' : 'badge-danger' }}"><i
                            class="far fa-clock mr-1"></i>{{ $reminder->due_date->diffForHumans() }}</small>
                    <div class="tools">
                        <i class="fas fa-trash-alt" wire:click='delete({{ $reminder->id }})'></i>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="button" id="addReminderBtn" class="btn btn-primary btn-sm float-right">
            <i class="fas fa-pencil-alt mr-2"></i>Nuevo recordatorio
        </button>
        <form id="addReminderForm" wire:submit.prevent='save' class="d-none" autocomplete="off">
            <div class="form-row">
                <div class="form-group col-md-8 mb-0">
                    <label for="reminderTitle" class="sr-only">Nuevo recordatorio</label>
                    <input type="text" wire:model.defer='reminderTitle' class="form-control form-control-sm"
                        id="reminderTitle" placeholder="Agregar recordatorio" />
                </div>
                <div class="form-group col-md-2 mb-0">
                    <label for="datepicker" class="sr-only">Fecha</label>
                    <input
                        wire:model.defer="reminderDueDate"
                        type="text"
                        class="form-control form-control-sm datepicker"
                        onchange="this.dispatchEvent(new InputEvent('input'))"
                        placeholder="Fecha"
                    />
                </div>
                <div class="form-group col-md-2 mb-0">
                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
