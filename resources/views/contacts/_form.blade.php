<div class="card-body">
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <x-forms.input name="name" value="{{ $contact->name }}">Nombre</x-forms.input>
        </div>
        <div class="form-group col-12 col-md-6">
            <x-forms.input name="lastname" value="{{ $contact->lastname }}">Apellidos</x-forms.input>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12 col-md-3">
            <x-forms.input type="tel" name="phone" pattern="[0-9]{10}" value="{{ $contact->phone }}">Teléfono</x-forms.input>
        </div>
        <div class="form-group col-12 col-md-3">
            <x-forms.input type="email" name="email" value="{{ $contact->email }}">E-mail</x-forms.input>
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="company_id">Seleccionar empresa</label>
            <select class="form-control select2" name="company_id" id="company_id">
                <option></option>
                @foreach ($companies as $id => $company)
                    <option value="{{ $id }}" {{ $id===$contact->company_id ? 'selected' : '' }}>{{ $company }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12 col-md-12">
            <label for="comments">Comentarios</label>
            <textarea class="form-control" name="comments" id="comments">{{ $contact->comments }}</textarea>
        </div>
    </div>
</div>
