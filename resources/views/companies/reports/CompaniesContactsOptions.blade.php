<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Parámetros</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ route('companies.report1') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="show">Mostrar</label>
                <select class="form-control" name="show" id="show">
                    <option value="1">Empresas sin contactos</option>
                    <option value="2">Empresas con contactos</option>
                    <option value="3">Todo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="order">Orden</label>
                <select class="form-control" name="order" id="order">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Procesar</button>
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Cancelar</button>
        </div>
    </form>
</div>
