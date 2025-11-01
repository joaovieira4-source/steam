<?php
require_once "conexao.php";
session_start();

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? null;
$csenha = $_POST['senha1'] ?? null;

// Identifica se é administrador ou usuário comum
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

// === ETAPA 1: Verificar se o e-mail existe ===
if (!isset($_SESSION['etapa']) || $_SESSION['etapa'] === 1) {

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
        // E-mail encontrado → próxima etapa
        $_SESSION['email'] = $email;
        $_SESSION['etapa'] = 2;
        $_SESSION['msg'] = "Email encontrado! Agora cadastre sua nova senha.";
        mysqli_stmt_close($stmt);
        header("Location: editar_senha.php");
        exit;
    } else {
        mysqli_stmt_close($stmt);
        $_SESSION['erro'] = "Usuário não encontrado!";
        header("Location: editar_senha.php");
        exit;
    }

}

// === ETAPA 2: Atualizar senha ===
if ($senha === '' || $senha !== $csenha) {
    $_SESSION['erro'] = "Senhas não conferem ou estão vazias!";
    header("Location: editar_senha.php");
    exit;
}

// Verifica se há e-mail salvo na sessão
if (empty($_SESSION['email'])) {
    $_SESSION['erro'] = "Sessão expirada. Digite seu email novamente.";
    $_SESSION['etapa'] = 1;
    header("Location: editar_senha.php");
    exit;
}

$email = $_SESSION['email'];
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
    unset($_SESSION['etapa']);
    unset($_SESSION['email']);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    header("Location: pagina.php");
    exit;
} else {
    $_SESSION['erro'] = "Falha ao atualizar senha. Verifique o email.";
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    header("Location: editar_senha.php");
    exit;
}
?>
