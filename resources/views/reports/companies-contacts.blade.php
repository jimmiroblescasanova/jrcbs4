<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Relación de Empresas y Contactos</title>

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
            <td class="titles">RELACIÓN DE EMPRESAS Y CONTACTOS</td>
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
                <th>Teléfono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($company->contacts as $row => $contact)
            <tr class="row">
                <td>{{ $row + 1 }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->email }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No existen contactos asociados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endforeach
</body>

</html>