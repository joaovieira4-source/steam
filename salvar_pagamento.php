<?php
require_once "conexao.php";

$data = $_POST['data'];
$forma_pagamento = $_POST['forma'];
$usuario_id = $_POST['usuario_id'];

$sql = "INSERT INTO pagamento (data, forma, usuario_id) VALUES (?, ?, ?)";

$comando = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($comando, 'ssi', $data, $forma_pagamento, $usuario_id);

mysqli_stmt_execute($comando);

mysqli_stmt_close($comando);

header("Location: pagina.php");

?>
