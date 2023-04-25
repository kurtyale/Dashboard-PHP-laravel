<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Relatório de dados coletados</title>
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

        /* Adicione este código CSS para imprimir o número da página */
        @page {
            counter-increment: page;
            counter-reset: page 1;
        }
        .page-number::after {
            content: "Página " counter(page);
        }
    </style>
</head>


<body>
    <div class="container">
        <h1>Relatório de dados coletados</h1>
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
        <p id="data-atual"></p>

        <script>
            var dataAtual = new Date();
            var dia = dataAtual.getDate();
            var mes = dataAtual.getMonth() + 1;
            var ano = dataAtual.getFullYear();
            var dataFormatada = dia + '/' + mes + '/' + ano;
            document.getElementById('data-atual').innerHTML = dataFormatada;

            // Adiciona o número da página atual
            function adicionarNumeroPagina() {
                var totalPages = document.querySelectorAll('.page-number').length;
                var currentPage = document.querySelectorAll('.page-number').length + 1;
                var currentPageText = 'Página ' + currentPage + ' de ' + totalPages;
                var pageElement = document.createElement('div');
                pageElement.classList.add('page-number');
                pageElement.innerText = currentPageText;
                document.body.appendChild(pageElement);
            }

            adicionarNumeroPagina();
        </script>
    </div>
</body>

</html>
