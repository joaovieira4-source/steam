<?php
    require_once "conexao.php";

    $id= $_GET['id'];
    $sql= "DELETE FROM tb_jogos WHERE Id_jogos= ?";

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);

    header("Location: listarteste.php");
?>