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
