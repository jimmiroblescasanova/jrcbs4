<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-building mr-2"></i>Empresas / Editar</h1>
        </div>
        <div class="col-sm-6">
            @can('edit companies')
                <button onclick="confirmDeletion();" type="button" class="btn btn-danger btn-sm float-right"><i
                        class="fas fa-trash-alt mr-2" aria-hidden="true"></i>Eliminar</button>
                <form action="{{ route('companies.destroy', $company) }}" method="POST" id="delete-company-form"
                    class="d-none">
                    @csrf @method('delete')
                </form>
            @endcan
            <button class="btn btn-default btn-sm mr-3 float-right" onclick="history.back();"><i
                    class="fas fa-arrow-left mr-2"></i>Atrás</button>
        </div>
    </x-slot>

    @if (session()->has('success'))
        <x-partials.alert type="success" icon="fas fa-check" :message="session('success')" />
    @endif

    <div class="row">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    Información general
                </div>
                <form action="{{ route('companies.update', $company) }}" role="form" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type='hidden' value='0' name='inactive'>
                    <input type='hidden' value='0' name='corporate'>
                    <div class="card-body">
                        <div class="form-group">
                            <x-forms.input type="text" name="name" :value="$company->name">Razón social:</x-forms.input>
                        </div>
                        <div class="form-group">
                            <x-forms.input type="text" name="rfc" :value="$company->rfc">RFC:</x-forms.input>
                        </div>
                        <div class="form-group">
                            <x-forms.input type="text" name="tradeName" :value="$company->tradeName">Nombre comercial:
                            </x-forms.input>
                        </div>
                        @if (!$company->parent()->exists())
                            <div class="row col-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="corporate" id="corporate"
                                            value="1" {{ $company->corporate ? 'checked' : '' }}>
                                        Empresa corporativo
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="inactive" id="inactive"
                                            value="1" {{ $company->inactive ? 'checked' : '' }}>
                                        Empresa inactiva
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <small class="text-black-50">Última actualización:
                                        {{ $company->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('edit companies')
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="fas fa-edit mr-2"></i>Actualizar</button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                @if (!$company->corporate)
                    <div class="card-header">
                        Corporativo padre
                    </div>
                    <form action="{{ route('companies.corporate', $company) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="belongsToCorporate" class="sr-only">Corporativo</label>
                                <select class="form-control" name="belongsToCorporate" id="belongsToCorporate">
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($corporates as $id => $corporateName)
                                        <option value="{{ $id }}"
                                            {{ $company->childrenOf === $id ? 'selected' : '' }}>
                                            {{ $corporateName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <button type="submit" class="btn btn-primary btn-sm"><i
                                    class="fas fa-edit mr-2"></i>Actualizar</button>
                        </div>
                    </form>
                @else
                    <div class="card-header">
                        Empresas hijas
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @foreach ($company->children as $child)
                                <li class="nav-item">
                                    <a href="{{ route('companies.show', $child->id) }}"
                                        class="nav-link">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <!-- Seccion de los programas asociados -->
            <div class="card">
                <div class="card-header">
                    Sistemas CONTPAQi asociados
                </div>
                <form action="{{ route('companies.sync', $company) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @foreach ($programs as $row => $program)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="programs[]"
                                        value="{{ $program->id }}" id="program-{{ $row }}"
                                        {{ $company->programs->contains($program->id) ? 'checked="checked"' : '' }} />{{ $program->fullProgramName }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        @can('edit companies')
                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-edit mr-2"></i>Actualizar</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Seccion de los contactos  -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @forelse($company->contacts as $contact)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Puesto
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-9">
                                        <h2 class="lead"><b>{{ $contact->name }}</b></h2>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone mr-2"></i></span>Teléfono:
                                                {{ $contact->phone }}</li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-envelope mr-2"></i></span>Email:
                                                {{ $contact->email }}</li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-clock mr-2"></i></span>Última actualización:
                                                {{ $contact->updated_at->diffForHumans() }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-3 text-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $contact->name }}"
                                            alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> Ver perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>No hay contactos asociados</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-slot name="custom_scripts">
        <script>
            function confirmDeletion() {
                Swal({
                        title: "Confirmar",
                        text: "Se eliminará la empresa, no se podrá recuperar finalizado el proceso. Los contactos serán des-asociados.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $('#delete-company-form').submit();
                        }
                    });
            }
        </script>
    </x-slot>
</x-main-layout>
