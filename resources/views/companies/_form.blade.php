<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('companies.store', '#create') }}" method="POST">
        @csrf
        <div class="modal-body">
            @error('programs')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <x-forms.input type="text" name="name">Razón social:</x-forms.input>
            </div>
            <div class="form-group">
                <x-forms.input type="text" name="rfc">RFC:</x-forms.input>
            </div>
            <div class="form-group">
                <x-forms.input type="text" name="tradename">Nombre comercial:</x-forms.input>
            </div>
            <div class="form-group">
                <p><strong>Sistemas CONTPAQi de la empresa:</strong></p>
                @foreach($programs as $i => $program)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="programs[]" id="program-{{ $i }}" value="{{ $program->id }}">
                            {{ $program->fullProgramName }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Guardar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Cancelar</button>
        </div>
    </form>
</div>
