<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Animes')</title>
    @vite('resources/css/app.css')
  </head>
  <body>

    <header style="padding: 20px; text-align: center;">
        <h1>Sistema de Animes</h1>
    </header>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer style="margin-top: 40px; text-align: center;">
        <small>&copy; {{ date('Y') }} Sistema de Animes</small>
    </footer>

  </body>
</html>