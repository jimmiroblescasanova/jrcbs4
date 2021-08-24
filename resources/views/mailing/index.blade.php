<x-main-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h1><i class="far fa-envelope mr-2"></i>Enviar correo masivo</h1>
        </div>
        <div class="col-sm-6">
            @can('create mailings')
            <div class="float-right">
                <a href="{{ route('mailing.create') }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-pencil-alt mr-2"></i>Nuevo</a>
            </div>
            @endcan
        </div>
    </x-slot>

    @if (session()->has('message'))
    <x-partials.alert type="success" icon="fas fa-check" :message="session('message')" />
    @endif

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Campañas Pendientes</div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estado</th>
                                <th>Día / Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td><span class="badge badge-warning">Procesando...</span></td>
                                <td>{{ getJobDate($job->created_at)  }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Campañas fallidas</div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Estado</th>
                                <th>Día / Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($failed_jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td><span class="badge badge-warning">Error</span></td>
                                <td>{{ $job->failed_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
