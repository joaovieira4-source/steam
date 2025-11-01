<?php
// Recebe email do formulário
$email = $_POST['email'];

// Consulta no banco se email existe
$user = consultaUsuarioPorEmail($email);

if ($user) {
    // Gerar token simples
    $token = bin2hex(random_bytes(16));
    $expires = time() + 3600; // 1 hora

    // Salvar token e expiração no banco
    salvarToken($user['id'], $token, $expires);

    // Montar link de recuperação
    $link = "https://seusite.com/redefinir-senha.php?token=$token";

    // Enviar email
    $assunto = "Recuperação de senha";
    $mensagem = "Clique no link para redefinir a senha: $link";
    mail($email, $assunto, $mensagem);
}

// Resposta genérica para não revelar se email existe
echo "Se o e-mail estiver cadastrado, você receberá instruções.";
?>