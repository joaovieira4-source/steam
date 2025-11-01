<?php
session_start();

// Define que estamos na etapa de atualizar senha
unset($_SESSION['senha']); // Limpa se existir
$_SESSION['senha'] = 2;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="style.css"> <!-- se tiver CSS -->
</head>
<body>

    <div class="login-container">
        <h2>Redefinir Senha</h2>

        <?php
        // Exibir mensagem de erro ou sucesso, se houver
        if (!empty($_SESSION['erro'])) {
            echo '<div class="erro-msg" style="color:red; margin-bottom:10px;">' . htmlspecialchars($_SESSION['erro']) . '</div>';
            $_SESSION['erro'] = '';
        }

        if (!empty($_SESSION['msg'])) {
            echo '<div class="msg-sucesso" style="color:green; margin-bottom:10px;">' . htmlspecialchars($_SESSION['msg']) . '</div>';
            $_SESSION['msg'] = '';
        }
        ?>

        <form action="verificar.php" method="post">
            <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?? null  ?>">
            <div class="input-box">
                <label for="senha">Senha</label><br>
                <input type="password" name="senha" id="senha" required><br>
            </div>

            <div class="input-box">
                <label for="senha1">Confirme a Senha</label><br>
                <input type="password" name="senha1" id="senha1" required><br>
            </div>

            <input type="submit" value="Enviar">
        </form>

        <p>
            Lembrou sua senha? <a href="index.php">Login</a>
        </p>
    </div>

</body>
</html>
