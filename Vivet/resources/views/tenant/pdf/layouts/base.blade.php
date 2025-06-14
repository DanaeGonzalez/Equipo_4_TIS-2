<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Documento')</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        h1 {
            margin: 0;
            font-size: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .content {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;

        }

        th,td {
            border: 1px solid #999;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }
    </style>
</head>

<body>

    <header>
        <h1>@yield('header-title', 'Reporte')</h1>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        Sistema Veterinario &copy; {{ date('Y') }}
    </footer>

</body>

</html>