<?php
session_start();
require_once "conexao.php";

// Verifica se foi enviado ?id= pela URL
$idFiltro = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];
$email = $_SESSION['email'];
// Decide a tabela e os nomes das colunas
if (str_ends_with($email, '@lojaexemplo.com')) {
    // Query sem filtro
    $sql = "
        SELECT uj.id, u.nome AS usuario, j.titulo AS jogo, uj.data_compra
        FROM tb_usuario_jogos uj
        JOIN tb_usuario u ON uj.usuario_id = u.id
        JOIN tb_jogos j ON uj.jogo_id = j.id
        ORDER BY uj.id DESC
    ";

    $stmt = mysqli_prepare($conexao, $sql);
} else {
    // Query com filtro por usuário
    $sql = "
        SELECT uj.id, u.nome AS usuario, j.titulo AS jogo, uj.data_compra
        FROM tb_usuario_jogos uj
        JOIN tb_usuario u ON uj.usuario_id = u.id
        JOIN tb_jogos j ON uj.jogo_id = j.id
        WHERE uj.usuario_id = ?
        ORDER BY uj.id DESC
    ";

    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idFiltro);
}

mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Usuários e Jogos Comprados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>

    <h2>Lista de Jogos Adquiridos pelos Usuários</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Jogo</th>
                <th>Data da Compra</th>
            </tr>
        </thead>
<tbody>
<?php 
while($linha = mysqli_fetch_assoc($resultado)) { 
    echo "<tr>";
    echo "<td>{$linha['id']}</td>";
    echo "<td>{$linha['usuario']}</td>";
    echo "<td>{$linha['jogo']}</td>";
    echo "<td>" . date('d/m/Y H:i', strtotime($linha['data_compra'])) . "</td>";
    echo "</tr>";
}
?>
</tbody>


    </table>

</body>

</html>
<?php mysqli_close($conexao); ?>
<?php
session_start();

$email = $_SESSION['email'] ?? null;

require_once "conexao.php";

// Buscar todos os jogos com o nome da categoria
$sql = "SELECT j.*, c.nome AS categoria_nome 
        FROM tb_jogos j
        JOIN categoria c ON j.categoria_id = c.id";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_execute($comando);
$resultados = mysqli_stmt_get_result($comando);
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
?>
</body>
</html>
