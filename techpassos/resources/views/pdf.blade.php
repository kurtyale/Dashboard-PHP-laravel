<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Relatório de Leitura</title>
    <!-- Estilos -->
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .page-number {
            text-align: right;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
        }

    </style>
</head>


<body>
    <div class="container">
        <h1>Relatório de Leitura</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Temperatura</th>
                    <th>Umidade</th>
                    <th>Data</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tabela as $linha)
                    <tr>
                        <td>{{ $linha->nome }}</td>
                        <td>{{ $linha->temperatura }}</td>
                        <td>{{ $linha->umidade }}</td>
                        <td>{{ $linha->data }}</td>
                        <td>{{ $linha->hora }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (Auth::check())
            <span class="d-none d-lg-inline-flex">Impresso por {{ Auth::user()->name }}</span>
        @endif

    </div>
</body>

</html>
