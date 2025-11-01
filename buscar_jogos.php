<?php
session_start();

$email = $_SESSION['email'] ?? null;

require_once "conexao.php";

// Pegar categoria_id enviado via GET
$categoria_id = $_GET['categoria_id'] ?? null;

if (!$categoria_id) {
    // Se não veio categoria, redireciona ou mostra todos
    header("Location: pagina.php");
    exit;
}

// Buscar jogos filtrando pela categoria
$sql = "SELECT j.*, c.nome AS categoria_nome 
        FROM tb_jogos j
        JOIN categoria c ON j.categoria_id = c.id
        WHERE c.id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, 'i', $categoria_id);
mysqli_stmt_execute($comando);
$resultados = mysqli_stmt_get_result($comando);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogos da Categoria</title>
    <style>
        img { width: 60px; height: 60px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: center; }
        .btn { padding: 5px 10px; text-decoration: none; background-color: #007BFF; color: white; border-radius: 3px; }
    </style>
</head>
<body>

<h2>Jogos da Categoria</h2>

<a href="pagina.php" class="btn">Voltar</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Plataforma</th>
            <th>Categoria</th>
            <?php
            if (str_ends_with($email, '@lojaexemplo.com')) {
                echo '<th>Editar</th>';
                echo '<th>Excluir</th>';
            } else {
                echo '<th>Comprar</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
<?php
while ($jogo = mysqli_fetch_assoc($resultados)) {
    echo '<tr>';
    echo '<td>' . $jogo['id'] . '</td>';
    echo '<td>';
    if ($jogo['foto']) {
        echo '<img src="fotos/' . htmlspecialchars($jogo['foto']) . '" alt="Foto do jogo">';
    }
    echo '</td>';
    echo '<td>' . htmlspecialchars($jogo['titulo']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['descricao']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['preco']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['estoque']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['plataforma']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['categoria_nome']) . '</td>';

    if (str_ends_with($email, '@lojaexemplo.com')) {
        echo '<td><a href="form_jogos.php?id=' . $jogo['id'] . '" class="btn">Editar</a></td>';
        echo '<td><a href="deletar_jogos.php?id=' . $jogo['id'] . '">
                <img src="delete.png" alt="Excluir"></a></td>';
    } else {
        echo '<td><a href="form_compra.php?id=' . $jogo['id'] . '">
                <img src="carrinho.png" alt="Comprar"></a></td>';
    }

    echo '</tr>';
}
?>
    </tbody>
</table>

<?php
mysqli_stmt_close($comando);
mysqli_close($conexao);
?>
</body>
</html>
