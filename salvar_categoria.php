<?php
require_once "conexao.php";

// Recebe os dados do formulário
$nome = $_GET['nome'];
$descricao = $_GET['descricao'];

// Prepara e executa a query
$sql = "INSERT INTO categoria (nome, descricao) VALUES (?, ?)";
$comando = mysqli_prepare($conexao, $sql);

if (!$comando) {
    die("Erro na preparação da query: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($comando, 'ss', $nome, $descricao);

if (mysqli_stmt_execute($comando)) {
    mysqli_stmt_close($comando);
    header("Location: pagina.php");
    exit;
} else {
    mysqli_stmt_close($comando);
    die("Erro ao salvar no banco: " . mysqli_stmt_error($comando));
}
?>
