<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Animes</title>
    <style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

    <h2>Lista de Animes</h2>
    <table style="width:100%">
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Criador</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>

        @foreach ($animes as $anime)
            <tr>
                <td>{{ $anime->id }}</td>
                <td>{{ $anime->title }}</td>
                <td>{{ $anime->genre }}</td>
                <td>{{ $anime->creator }}</td>
                <td>{{ $anime->release_year }}</td>
                <td class="actions">
                    <a href="{{ route('animes.show', $anime) }}">Visualizar</a> |
                    <a href="{{ route('animes.edit', $anime) }}">Editar</a> |
                    <form action="{{ route('animes.destroy', $anime) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Deseja excluir este anime?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ url('/') }}" class="btn btn-secondary" style="margin-bottom: -220px; display: inline-block;"> Voltar </a>
</body>
</html>