<?php
require_once "conexao.php"; // Assume-se que $conexao está OK

$id= $_GET['id'];

// Decide tabela e colunas
if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
    $nome_col = 'nome';
    $email_col = 'email';
    $senha_col = 'senha';
} else {
    $tabela = 'tb_usuario';
    $nome_col = 'nome';
    $email_col = 'email';
    $senha_col = 'senha';
}

$sql = "DELETE FROM $tabela WHERE id = ? ";

$comando = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($comando, "i", $id);

mysqli_stmt_execute($comando);

header("Location: index.php");
?>