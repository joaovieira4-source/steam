<?php
// require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obter o email do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        // Verificar se o email existe no "banco de dados" (simulado para este exemplo)
        // $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        // $stmt->execute([$email]);
        // $user = $stmt->fetch();

        // Simulação de verificação de email
        $userExists = ($email === "teste@example.com"); // Substitua por sua lógica real de DB

        if ($userExists) {
            // 3. Gerar um token de redefinição único
            // Em produção, use algo como random_bytes e base64_encode para tokens mais seguros
            $token = bin2hex(random_bytes(32)); // Gera um token hexadecimal de 64 caracteres

            // 4. Salvar o token no banco de dados associado ao usuário e com um timestamp de expiração
            // Exemplo SQL:
            // $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))");
            // $stmt->execute([$email, $token]);

            // 5. Construir o link de redefinição
            // O link apontaria para uma página onde o usuário realmente redefiniria a senha,
            // por exemplo: http://seusite.com/reset_password.php?token=SEUTOKEN
            $resetLink = "http://localhost/reset_password.php?token=" . $token; // Ajuste o URL base

            // 6. Enviar o email com o link
            // Em produção, use uma biblioteca como PHPMailer para envio de e-mails robusto
            $subject = "Redefinição de Senha";
            $message = "Olá,\n\nVocê solicitou a redefinição de senha. Clique no link abaixo para redefinir:\n\n" . $resetLink . "\n\nSe você não solicitou isso, ignore este email.";
            $headers = "From: no-reply@seusite.com\r\n";
            $headers .= "Reply-To: no-reply@seusite.com\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

            // A função mail() do PHP requer um servidor de email configurado (MTA)
            // Em ambiente de desenvolvimento, pode não funcionar sem configuração.
            // Para testar, você pode usar um serviço como Mailtrap ou PHPMailer com SMTP.
            if (mail($email, $subject, $message, $headers)) {
                $response = "Um link de redefinição de senha foi enviado para seu email.";
            } else {
                $response = "Erro ao enviar o email. Tente novamente mais tarde.";
            }

        } else {
            $response = "Não encontramos uma conta com este email.";
        }
    } else {
        $response = "Email inválido.";
    }
    // Redirecionar ou exibir a resposta na mesma página
    // Para simplificar, vamos apenas exibir a resposta aqui.
    echo "<p>" . $response . "</p>";
    echo "<p><a href='index.html'>Voltar para o Login</a></p>";
} else {
    // Se a requisição não for POST, redireciona ou exibe o formulário
    header("Location: forgot-password.html");
    exit();
}
?>