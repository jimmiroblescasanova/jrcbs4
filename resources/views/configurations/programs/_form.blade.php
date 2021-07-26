<div class="form-group">
    <label for="name">Nombre del sistema</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $program->name }}">
</div>
<div class="form-group">
    <label for="type">Tipo de licenciamiento</label>
    <select class="form-control" name="annual_license" id="type">
        <option value="0" {{ ($program->annual_license == 0) ? 'selected' : '' }}>Tradicional</option>
        <option value="1" {{ ($program->annual_license == 1) ? 'selected' : '' }}>Anual</option>
    </select>
</div>
