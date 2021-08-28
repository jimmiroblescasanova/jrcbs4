<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTES</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    @livewireStyles
</head>

<body>
    <div class="container-fluid flex-column bg-light">

        <div class="row p-3">
            <div class="col-12 text-center">
                <h1>{{ $title ?? 'REPORTE' }}</h1>
            </div>
        </div>

        {{ $slot }}
    </div>

    <!-- Scripts -->
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    <script>
        Livewire.on('generateReport', result => {
            console.log(result);

            if (result) {
                let url = "{{ asset('reports/report.pdf') }}";
                $('#reportPage').attr('data', url);
            }

        });
    </script>
</body>

</html>
