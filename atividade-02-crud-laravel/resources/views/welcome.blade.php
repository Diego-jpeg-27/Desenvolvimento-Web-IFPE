 <!DOCTYPE html>
  <html lang="pt-br">
   <head>
    <meta charset="UTF-8">
    <title>AnimeDex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   </head>
  <body>

  <h2 class="titulo">Sistema de Cadastros de Animes</h2>

   <div class="container-home">
     <div class="botoes">
            <a href="{{ route('animes.create') }}" class="btn-home">Cadastrar</a>
            <a href="{{ route('animes.index') }}" class="btn-home">Gerenciar</a>
            <a href="{{ route('animes.lista') }}" class="btn-home">Lista</a>
     </div>
   </div>
  </body>
 </html> 