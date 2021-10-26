<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Relación de Empresas y Programas</title>

    <style>
        .table {
            border-collapse: collapse;
            margin-bottom: 35px;
            width: 100%;
        }

        .table th {
            background-color: #04AA6D;
            color: white;
        }

        .table th,
        td {
            border-bottom: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .half-table {
            border-collapse: collapse;
            width: 65%;
        }

        .half-table .table-title {
            background-color: #f2f2f2;
            width: 20%;
        }

        .titles-table {
            border-collapse: collapse;
            margin-bottom: 50px;
            width: 100%;
        }

        .titles-table .titles {
            font-family: "Nunito", sans-serif;
            font-size: large;
        }

        .titles-table .logo {
            text-align: left;
            vertical-align: text-top;
            width: 20%;
        }

        .titles-table .logo img {
            width: 100px;
        }

        .titles-table .dates {
            text-align: right;
            vertical-align: text-top;
            width: 20%
        }
    </style>
</head>

<body>
    <table class="titles-table">
        <tr>
            <td class="logo">
                <img src="{{ asset('logo_small.jpg') }}" alt="logo">
            </td>
            <td class="titles">RELACIÓN DE EMPRESAS Y PROGRAMAS</td>
            <td class="dates">
                <span>{{ NOW()->format('d/m/Y') }}</span>
            </td>
        </tr>
    </table>
    @foreach($companies as $company)
    <table class="half-table">
        <tr>
            <td class="table-title">Empresa:</td>
            <td>{{ $company->name }}</td>
        </tr>
        <tr>
            <td class="table-title">RFC:</td>
            <td>{{ $company->rfc }}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @forelse($company->programs as $row => $program)
            <tr class="row">
                <td>{{ $row + 1 }}</td>
                <td>{{ $program->name . ($program->annual_license) ? ' Anual' : ' Tradicional' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">No existen programas asociados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endforeach
</body>

</html>
