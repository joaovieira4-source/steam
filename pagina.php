<?php
session_start();
require_once 'conexao.php';

$email = $_SESSION['email'] ?? null;

if ($email === null) {
    // Se não estiver logado, redireciona
    header("Location: index.php");
    exit;
}

// Decide a tabela e os nomes das colunas
if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
} else {
    $tabela = 'tb_usuario';
}

// Busca os dados do usuário/admin
$sql = "SELECT * FROM $tabela WHERE email = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "s", $email);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
$resposta = mysqli_fetch_assoc($resultado);

// Define variáveis do usuário
$id        = $resposta['id'];
$nome      = $resposta['nome'];
$email     = $resposta['email'];
$senhaHash = $resposta['senha'];

// Salva na sessão
$_SESSION['id'] = $id;
$_SESSION['nome_usuario'] = $nome;
$_SESSION['email'] = $email;

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página do Perfil</title>
  <link rel="stylesheet" href="pagina.css" />
  <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet" />
</head>

<body>

  <header class="main-header">
    <h1 class="logo">Play Zone</h1>
    <nav class="profile-nav">
      <p class="nome_do_usuario">
        <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?>
      </p>
      <div class="profile-picture" id="profileToggle">
        <ion-icon name="person-circle-outline"><img src="perfil.jpg" alt="Perfil"></ion-icon>
      </div>
      <div class="profile-menu" id="profileMenu">
        <a href="carrinho.php" class="menu-item">
          <ion-icon name="cart-outline"></ion-icon> Carrinho
        </a>
        <a href="#" class="menu-item">
          <ion-icon name="settings-outline"></ion-icon> Configurações
        </a>
        <a href="excluir_conta.php?id=<?php echo $id; ?>" class="menu-item delete-account">
          <ion-icon name="trash-outline"></ion-icon> Excluir Conta
        </a>
        <a href="logout.php" class="menu-item logout">
          <ion-icon name="log-out-outline"></ion-icon> Sair
        </a>
      </div>
    </nav>
  </header>

  <div class="toggle-container" style="justify-items: end;">
    <label class="switch">
      <input type="checkbox" id="modeToggle" />
      <span class="slider"></span>
    </label>
    <span id="toggleLabel">OFF</span>
  </div>

  <main class="content">
    <h1>Bem-vindo(a) ao seu perfil!</h1>
    <p>Este é o conteúdo principal da sua página.</p>
    <p>Aqui você pode exibir informações do usuário, posts, etc.</p>

    <!-- Links para cadastro e listagem -->
    <div class="links-crud">
      <a href="form_jogos.php">Adicionar Jogo</a><br>
      <a href="form_categoria.php">Adicionar Categoria</a><br>
      <a href="listagemcrud.php">Listagem Geral</a><br>
      <a href="form_pagamento.php">
        <button>Comprar</button>
      </a>
    </div>
  </main>

  <script src="script.js"></script>
</body>

</html>
