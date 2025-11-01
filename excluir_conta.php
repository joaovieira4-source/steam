<?php
session_start();
require_once "conexao.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID não informado.");
}

$id = intval($_GET['id']);
$email = $_SESSION['email'] ?? '';

if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
} else {
    $tabela = 'tb_usuario';
}

// Se for usuário comum, apaga dependências antes
if ($tabela === 'tb_usuario') {
    $sqlDependencias = "DELETE FROM tb_usuario_jogos WHERE usuario_id = ?";
    $stmtDep = mysqli_prepare($conexao, $sqlDependencias);
    mysqli_stmt_bind_param($stmtDep, "i", $id);
    mysqli_stmt_execute($stmtDep);
    mysqli_stmt_close($stmtDep);
}

// Agora apaga o usuário/adm
$sql = "DELETE FROM $tabela WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    session_destroy(); // encerra a sessão
    header("Location: index.php");
    exit;
} else {
    $erro = mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    die("Erro ao excluir: $erro");
}
?>
