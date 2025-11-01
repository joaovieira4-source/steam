<?php
    require_once "conexao.php";

  $idusuario = $_POST['idusuario'];
  $idjogo = $_POST['idjogo'];
  $data = $_POST['data'];

  $sql="INSERT INTO tb_usuario_jogos (usuario_id, jogo_id, data_compra) VALUES (?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'iis', $idusuario, $idjogo, $data);

  mysqli_stmt_execute($comando);

  mysqli_stmt_close($comando);

  header("Location: form_pagamento.php");
?>