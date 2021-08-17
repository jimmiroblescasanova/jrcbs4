<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-building mr-2"></i>Empresas / Editar</h1>
        </div>
        <div class="col-sm-6">
            <button onclick="confirmDeletion();" type="button" class="btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt mr-2" aria-hidden="true"></i>Eliminar</button>
            <form action="{{ route('companies.destroy', $company) }}" method="POST" id="delete-company-form" class="d-none">
                @csrf @method('delete')
            </form>
        </div>
    </x-slot>

    @if(session()->has('success'))
        <x-partials.alert type="success" icon="fas fa-check" :message="session('success')" />
    @endif

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Información general
                </div>
                <form action="{{ route('companies.update', $company) }}" role="form" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Razón Social:</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}">
                        </div>
                        <div class="form-group">
                            <label for="rfc">R.F.C.</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" value="{{ $company->rfc }}">
                        </div>
                        <div class="form-group">
                            <x-forms.input type="text" name="tradename" :value="$company->tradename">Nombre comercial:</x-forms.input>
                        </div>
                        <small class="text-black-50">Última actualización: {{ $company->updated_at->diffForHumans() }}</small>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit mr-2"></i>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Sistemas CONTPAQi asociados
                </div>
                <form action="{{ route('companies.sync', $company) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @foreach($programs as $row => $program)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="programs[]"
                                        value="{{ $program->id }}"
                                        id="program-{{ $row }}"
                                        {{ ( $company->programs->contains($program->id) ) ? 'checked="checked"' : '' }}
                                    />{{ $program->name }} {{ ($program->annual_license) ? 'Anual' : 'Tradicional' }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-edit mr-2"></i>Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
{{--                                        <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone mr-2"></i></span>Teléfono: {{ $contact->phone }}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope mr-2"></i></span>Email: {{ $contact->email }}</li>
                                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock mr-2"></i></span>Última actualización: {{ $contact->updated_at->diffForHumans() }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-3 text-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $contact->name }}" alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    {{--<a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                    </a>--}}
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
                swal({
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
                    }
                );
            }
        </script>
    </x-slot>
</x-main-layout>
