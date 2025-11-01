<?php
require_once "conexao.php"; // Assume-se que $conexao está OK

$id= $_GET['id'];

$sql = "DELETE FROM tb_usuario WHERE id_usuarios = ? ";

$comando = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($comando, "i", $id);

mysqli_stmt_execute($comando);

header("Location: index.php");
?>