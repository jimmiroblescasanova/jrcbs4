<x-main-layout>
    <x-slot name="header">
        <h1>Inicio</h1>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Titulo del card</h3>
        </div>
        <form action="">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="contact_id">Seleccionar un contacto</label>
                        <select class="form-control" name="contact_id" id="contact_id">
                            @foreach ($contacts as $id => $contact)
                                <option value="{{ $id }}">{{ $contact }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-3">
                        <label for="activity_id">Actividad</label>
                        <select class="form-control" name="activity_id" id="activity_id">
                            @foreach ($activities as $id => $activity)
                                <option value="{{ $id }}">{{ $activity }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-3">
                        <label for="tag_id">Seleccionar una etiqueta</label>
                        <select class="form-control" name="tag_id" id="tag_id">
                            @foreach ($tags as $id => $tag)
                                <option value="{{ $id }}">{{ $tag }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-12">
                        <label for="">Comentarios</label>
                        <textarea class="form-control" name="" id="" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <button type="button" class="btn btn-default btn-sm float-right" onclick="history.back();">Atras</button>
            </div>
            <!-- /.card-footer-->
        </form>
    </div>
</x-main-layout>
