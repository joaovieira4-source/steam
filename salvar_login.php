<?php
require_once 'conexao.php';
session_start();

// Recebe dados do formulário
$email = trim($_POST['email']);
$senha = $_POST['senha'];

// Decide a tabela e os nomes das colunas
if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
    $col_nome = 'nome';
    $col_email = 'email';
    $col_senha = 'senha';
} else {
    $tabela = 'tb_usuario';
    $col_nome = 'nome';
    $col_email = 'email';
    $col_senha = 'senha';
}

// Prepara a query
$sql = "SELECT $col_nome, $col_senha FROM $tabela WHERE $col_email = ?";
$comando = mysqli_prepare($conexao, $sql);
if (!$comando) {
    die("Erro na preparação da consulta: " . mysqli_error($conexao));
}

// Liga os parâmetros e executa
mysqli_stmt_bind_param($comando, "s", $email);
mysqli_stmt_execute($comando);

// Armazena o resultado
mysqli_stmt_store_result($comando);

if (mysqli_stmt_num_rows($comando) === 0) {
    // Email não encontrado
    $_SESSION['erro'] = "Email incorreto!";
    header("Location: index.php");
    exit;
}

// Liga variáveis para buscar os resultados
mysqli_stmt_bind_result($comando, $nome_usuario, $hash_senha);
mysqli_stmt_fetch($comando);

// Verifica a senha
if (password_verify($senha, $hash_senha)) {
    $_SESSION['nome_usuario'] = $nome_usuario;
    $_SESSION['email'] = $email;
    mysqli_close($conexao);
    header("Location: pagina.php");
    exit;
} else {
    $_SESSION['erro'] = "Senha incorreta!";
    header("Location: index.php");
    exit;
}
?>
