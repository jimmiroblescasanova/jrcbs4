<div>
    <div class="form-group">
        <label for="program">Seleccionar un programa</label>
        <select class="form-control" wire:model='selectedProgram' name="program" id="program">
            @foreach ($programs as $id => $program)
            <option value="{{ $id }}">{{ $program }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-5">
            <select name="from[]" id="multiselect" class="form-control" size="8" multiple="multiple">
                @if ( !is_null($selectedProgram) )
                @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                @endif
            </select>
        </div>

        <div class="col-2">
            <button type="button" id="multiselect_rightAll" class="btn btn-block"><i
                    class="fas fa-fast-forward"></i></button>
            <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i
                    class="fas fa-step-forward"></i></button>
            <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i
                    class="fas fa-step-backward"></i></button>
            <button type="button" id="multiselect_leftAll" class="btn btn-block"><i
                    class="fas fa-fast-backward"></i></button>
        </div>

        <div class="col-5">
            <select name="to[]" id="multiselect_to" class="form-control" size="8" multiple="multiple"></select>
        </div>
    </div>
</div>
