<?php
session_start();
$_SESSION['senha'] = 1;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recuperar Senha</title>
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
    <h2>Recuperar Senha</h2>

    <form action="verificar.php" method="post">
      <div class="input-box">
        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
        <input type="email" name="email" required placeholder="Digite seu email" />
        <label>Email</label>
        <div class="input-line"></div>
      </div>

      <button type="submit" class="cadastrar">Redefinir Senha</button>

      <p class="register-link">
        Lembrou sua senha? <a href="index.php">Login</a>
      </p>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>
