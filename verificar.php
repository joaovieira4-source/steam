<?php
require_once "conexao.php";
session_start();

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? null;
$csenha = $_POST['senha1'] ?? null;

// Decide tabela e colunas
if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
    $col_nome = 'adm_nome';
    $col_email = 'adm_email';
    $col_senha = 'amd_senha';
} else {
    $tabela = 'tb_usuario';
    $col_nome = 'usuarios_nome';
    $col_email = 'usuarios_email';
    $col_senha = 'usuarios_senha';
}

// Primeira vez: verificar se email existe
if (!empty($_SESSION['senha']) && $_SESSION['senha'] == 1) {

    if ($email === '') {
        $_SESSION['erro'] = "O campo de email não pode ficar vazio.";
        header("Location: editar_senha.php");
        exit;
    }

    $sql = "SELECT $col_nome FROM $tabela WHERE $col_email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    if (!$stmt) {
        $_SESSION['erro'] = "Erro na preparação da query: " . mysqli_error($conexao);
        header("Location: editar_senha.php");
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        header("Location: editar_senha.php"); // email existe, segue para cadastro nova senha
        $_SESSION['email'] = $email;
        exit;
    } else {
        mysqli_stmt_close($stmt);
        $_SESSION['erro'] = "Usuário não encontrado!";
        header("Location: editar_senha.php");
        exit;
    }

} else {
    // Atualizar senha
    if ($senha === '' || $senha !== $csenha) {
        $_SESSION['erro'] = "Senhas não conferem ou estão vazias!";
        header("Location: editar_senha.php");
        exit;
    }

    $hash = password_hash($csenha, PASSWORD_DEFAULT);



     $sql = "UPDATE $tabela SET $col_senha = ? WHERE $col_email = ?";
     $stmt = mysqli_prepare($conexao, $sql);
     if (!$stmt) {
         $_SESSION['erro'] = "Erro na preparação da query: " . mysqli_error($conexao);
         header("Location: editar_senha.php");
         exit;
     }

     mysqli_stmt_bind_param($stmt, "ss", $hash, $email);
     mysqli_stmt_execute($stmt);

     if (mysqli_stmt_affected_rows($stmt) > 0) {
         $_SESSION['msg'] = "Senha atualizada com sucesso!";
         mysqli_stmt_close($stmt);
         mysqli_close($conexao);
         header("Location: pagina.php");
         exit;
     } else {
         mysqli_stmt_close($stmt);
         mysqli_close($conexao);
         $_SESSION['erro'] = "Falha ao atualizar senha. Verifique o email.";
         header("Location: editar_senha.php");
         exit;
     }
}

mysqli_close($conexao);
?>
