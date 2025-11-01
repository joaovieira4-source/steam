<?php

    require_once "conexao.php";

    $nome= $_GET['nome'];
    $descricao= $_GET['descricao'];

    $sql= "INSERT INTO categoria (nome, descricao) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ss', $nome, $descricao);

    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);

    header("Location: pagina.php");
?>