<?php
session_start();
$erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : '';
unset($_SESSION['erro']); // Limpa depois de pegar
$_SESSION['usuario_logado'] = true; 
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login com Modo Neon</title>
  <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" /> <!-- Link para o arquivo CSS -->
</head>

<body>
  <!--Botão de ligar e desligar-->
  <div class="toggle-container">
    <label class="switch">
      <input type="checkbox" id="modeToggle" />
      <span class="slider"></span>
    </label>
    <span id="toggleLabel">OFF</span>
  </div>

  <div class="login-container">
    <h2>Login</h2>

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

   
    <form action="salvar_login.php" method="POST">
      <div class="input-box">
        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
        <input type="email" name="email" required />
        <label>Email</label>
        <div class="input-line"></div>
      </div>

      <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password" name="senha" required />
        <label>Password</label>
        <div class="input-line"></div>
      </div>

      <div class="remember-forgot">
        <label><input type="checkbox" />Me lembre</label>
        <a href="recupera_senha.php">esqueceu a senha?</a>
      </div>

      <button type="submit">Login</button>

      <p class="register-link">
        Não tem uma conta? <a href="registro.php">Cadastrar</a>
      </p>
      <p class="register-link">
        <a href="pagina.php">Permanecer anonimo</a>
      </p>
    </form>
  </div>

  <script src="script.js"></script>
</body>

</html>