<div class="row flex-grow-1">
    <div id="first-column" class="col-4 p-3 flex-fill">
        <form wire:submit.prevent="generate">
            <fieldset>
                <legend class="text-center">Parámetros</legend>

                <div class="form-group">
                    <label for="show">Mostrar</label>
                    <select id="show" class="form-control shadow-sm" wire:model.lazy="show">
                        <option value="">Seleccionar una opción</option>
                        <option value="1">Empresas sin contactos</option>
                        <option value="2">Empresas con contactos</option>
                        <option value="3">Todo</option>
                    </select>
                    @error('show') <small class="text-muted">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="order">Orden</label>
                    <select id="order" class="form-control shadow-sm" wire:model.lazy="order">
                        <option value="">Seleccionar una opción</option>
                        <option value="asc">Ascendente</option>
                        <option value="desc">Descendente</option>
                    </select>
                    @error('order') <small class="text-muted">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" wire:model.lazy="status" value="1">
                            Incluir empresas inactivas
                        </label>
                    </div>
                </div>

            </fieldset>

            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-poll mr-2"></i>Procesar</button>
            <button type="reset" class="btn btn-default btn-sm">Reset</button>
        </form>
    </div>

    <div id="second-column" class="col-8 flex-fill">
        <object data="" type="application/pdf" id="reportPage" width="100%" height="100%"></object>
    </div>
</div>
