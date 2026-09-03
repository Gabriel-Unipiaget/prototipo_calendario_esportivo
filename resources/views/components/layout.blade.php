<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <title>{{ $title }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CALENDÁRIO -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@7.0.2/all/global.js"></script>

    <!-- LOCALE PT-BR -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@7.0.2/locales/pt-br/global.js"></script>

    <!-- THEME JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@7.0.2/global.js"></script>

    <!-- STYLESHEETS -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@7.0.2/skeleton.css' rel='stylesheet' />
    <link href='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@7.0.2/theme.css' rel='stylesheet' />

    <!-- Bootstrap CSS v5.3.8 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />

    <link rel="icon" type="image/x-icon" href="{{ asset('internet.png') }}">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
