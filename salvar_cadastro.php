<?php
require_once "conexao.php";
session_start();

// Recebe os dados do formulário'
$usuario = trim($_POST['usuario']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$csenha = $_POST['csenha'];

// Valida campo usuário
if ($usuario === '') {
    $_SESSION['erro'] = "O campo de usuário não pode estar vazio ou conter apenas espaços.";
    header("Location: registro.php");
    exit;
}

// Valida senhas
if ($senha !== $csenha) {
    $_SESSION['erro'] = "As senhas não coincidem. Por favor, verifique.";
    header("Location: registro.php");
    exit;
}

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

// Verifica se o email ou usuário já existe
$sql_check = "SELECT 1 FROM $tabela WHERE $nome_col = ? OR $email_col = ?";
$comando_check = mysqli_prepare($conexao, $sql_check);
mysqli_stmt_bind_param($comando_check, "ss", $usuario, $email);
mysqli_stmt_execute($comando_check);
mysqli_stmt_store_result($comando_check);

if (mysqli_stmt_num_rows($comando_check) > 0) {
    $_SESSION['erro'] = "Este usuário ou e-mail já está registrado!";
    header("Location: registro.php");
    exit;
}

// Insere usuário/admin
$sql = "INSERT INTO $tabela ($nome_col, $email_col, $senha_col) VALUES (?, ?, ?)";
$comando = mysqli_prepare($conexao, $sql);
if (!$comando) {
    $_SESSION['erro'] = "Erro na preparação da query: " . mysqli_error($conexao);
    header("Location: registro.php");
    exit;
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
mysqli_stmt_bind_param($comando, "sss", $usuario, $email, $senha_hash);

if (mysqli_stmt_execute($comando)) {
    $_SESSION['nome_usuario'] = $usuario;
    $_SESSION['email'] = $email;
    mysqli_close($conexao);
    header("Location: pagina.php");
    exit;
} else {
    $_SESSION['erro'] = "Erro ao salvar no banco: " . mysqli_stmt_error($comando);
    header("Location: registro.php");
    exit;
}
