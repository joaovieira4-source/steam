<?php
require_once "conexao.php";

// Verifica se o ID foi enviado
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do jogo não informado.");
}

$id = intval($_GET['id']); // garante que é um número inteiro

// Primeiro remove vínculos na tabela de relação (usuário_jogos)
$sqlDependencias = "DELETE FROM tb_usuario_jogos WHERE jogo_id = ?";
$stmtDep = mysqli_prepare($conexao, $sqlDependencias);
mysqli_stmt_bind_param($stmtDep, "i", $id);
mysqli_stmt_execute($stmtDep);
mysqli_stmt_close($stmtDep);

// Agora remove o jogo
$sql = "DELETE FROM tb_jogos WHERE id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);

if (mysqli_stmt_execute($comando)) {
    mysqli_stmt_close($comando);
    header("Location: listagemcrud.php");
    exit;
} else {
    $erro = mysqli_stmt_error($comando);
    mysqli_stmt_close($comando);
    die("Erro ao excluir o jogo: $erro");
}
?>
