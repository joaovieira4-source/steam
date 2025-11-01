<?php
session_start();

$email = $_SESSION['email'] ?? null;

require_once "conexao.php";

// Buscar todos os jogos
$sql = "SELECT * FROM tb_jogos";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_execute($comando);
$resultados = mysqli_stmt_get_result($comando);
var_dump($resultados);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Jogos</title>
    <style>
        img {
            width: 60px;
            height: 60px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            border-radius: 3px;
        }
    </style>
</head>
<body>

<h2>Lista de Jogos</h2>

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
<tbody>
<?php
while ($jogo = mysqli_fetch_assoc($resultados)) {
    echo '<tr>';
    echo '<td>' . $jogo['id_jogos'] . '</td>';
    echo '<td>';
    if ($jogo['foto']) {
        echo '<img src="fotos/' . htmlspecialchars($jogo['foto']) . '" alt="Foto do jogo">';
    }
    echo '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_titulo']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_descricao']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_preco']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_estoque']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_plataforma']) . '</td>';
    echo '<td>' . htmlspecialchars($jogo['jogos_categoria']) . '</td>';

    if (str_ends_with($email, '@lojaexemplo.com')) {
        echo '<td><a href="form_jogos.php?id=' . $jogo['id_jogos'] . '" class="btn">Editar</a></td>';
        echo '<td><a href="deletar_jogos.php?id=' . $jogo['id_jogos'] . '">
                <img src="delete.png" alt="Excluir"></a></td>';
    } else {
        echo '<td href="form_compra.php"><a></a><img src"carrinho.png">Comprar</td>';
    }

    echo '</tr>';
}
 var_dump($jogo);
?>
</tbody>

    </tbody>
</table>

<?php
mysqli_stmt_close($comando);
?>
</body>
</html>
