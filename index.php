<?php include 'crud.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Filmes</title>
    <link rel="stylesheet" href="index.css" />
</head>

<body>
    <h1>Cadastro de Filmes</h1>

    <h2>Adicionar Filme</h2>
    <form action="crud.php" method="POST">
        <input type="hidden" name="action" value="create">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <label for="genero">Gênero:</label>
        <input type="text" name="genero" required>
        <label for="avaliacao">Avaliação:</label>
        <input type="text" name="avaliacao" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Lista de Filmes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Avaliação</th>
            <th>Ações</th>
        </tr>
        <?php
        $filmes = readFilms();
        foreach ($filmes as $filme) {
            echo "<tr>";
            echo "<td>{$filme['id']}</td>";
            echo "<td>{$filme['nome']}</td>";
            echo "<td>{$filme['genero']}</td>";
            echo "<td>{$filme['avaliacao']}</td>";
            echo "<td>";
            echo "<form action='index.php' method='GET' style='display:inline-block;'>";
            echo "<input type='hidden' name='edit' value='true'>";
            echo "<input type='hidden' name='id' value='{$filme['id']}'>";
            echo "<input type='hidden' name='nome' value='{$filme['nome']}'>";
            echo "<input type='hidden' name='genero' value='{$filme['genero']}'>";
            echo "<input type='hidden' name='avaliacao' value='{$filme['avaliacao']}'>";
            echo "<button type='submit'>Editar</button>";
            echo "</form>";
            echo "<form action='crud.php' method='POST' style='display:inline-block;'>";
            echo "<input type='hidden' name='action' value='delete'>";
            echo "<input type='hidden' name='id' value='{$filme['id']}'>";
            echo "<button type='submit'>Excluir</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit'])): ?>
        <h2>Editar Filme</h2>
        <form action="crud.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $_GET['nome']; ?>" required>
            <label for="genero">Gênero:</label>
            <input type="text" name="genero" value="<?php echo $_GET['genero']; ?>" required>
            <label for="avaliacao">Avaliação:</label>
            <input type="text" name="avaliacao" value="<?php echo $_GET['avaliacao']; ?>" required>
            <button type="submit">Atualizar</button>
        </form>
    <?php endif; ?>
</body>

</html>