<?php
session_start();
$erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : '';
unset($_SESSION['erro']); // Limpa depois de pegar
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro com Modo Neon</title>
  <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div class="toggle-container">
    <label class="switch">
      <input type="checkbox" id="modeToggle" />
      <span class="slider"></span>
    </label>
    <span id="toggleLabel">OFF</span>
  </div>

  <div class="login-container">
    <h2>Registrar</h2>

    <?php
    if (!empty($erro)) {
    echo '<div class="erro-msg" style="color: red; text-align:center; margin-bottom:10px;">' 
         . htmlspecialchars($erro) . 
         '</div>';
} 
    ?>

    <form action="salvar_cadastro.php" method="POST">
      <div class="input-box">
        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
        <input type="text" name="usuario"  />
        <label>Nome de Usuário</label>
        <div class="input-line"></div>
      </div>

      <div class="input-box">
        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
        <input type="email" name="email"  />
        <label>Email</label>
        <div class="input-line"></div>
      </div>

      <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password" name="senha"  />
        <label>Senha</label>
        <div class="input-line"></div>
      </div>

      <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password" name="csenha"  />
        <label>Confirmar Senha</label>
        <div class="input-line"></div>
      </div>

      <input type="submit" value="Cadastrar" class="cadastrar">

      <p class="register-link">
        Já tem uma conta? <a href="index.php">Login</a>
      </p>
    </form>
  </div>

  <script src="script.js"></script>
</body>

</html>
