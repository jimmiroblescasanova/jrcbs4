<div class="row vh-100">
    <div class="col-4 first-column p-3">
        <form wire:submit.prevent="generate">

            <div class="form-group">
                <label for="show">Mostrar</label>
                <select class="form-control" wire:model.lazy="show">
                    <option value="">Selecciona una opción</option>
                    <option value="1">Empresas con programas</option>
                    <option value="2">Empresas sin programas</option>
                </select>
                @error('show') <small class="text-muted">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="order">Orden</label>
                <select class="form-control" wire:model.lazy="order">
                    <option value="">Selecciona una opción</option>
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
                @error('order') <small class="text-muted">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="programSelected">Programas</label>
                <select multiple class="form-control" size="8" wire:model.lazy="programSelected">
                    @foreach ($programs as $id => $program)
                    <option value="{{ $id }}">{{ $program }}</option>
                    @endforeach
                </select>
                @error('programSelected') <small class="text-muted">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" wire:model.lazy="status" value="1">
                        Incluir empresas inactivas
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Procesar</button>
            <button type="reset" class="btn btn-default btn-sm">Reset</button>
        </form>
    </div>

    <div class="col-8 second-column">
        <object data="" type="application/pdf" id="reportPage" width="100%" height="100%"></object>
    </div>
</div>
