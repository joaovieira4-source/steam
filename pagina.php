<?php
session_start();
require_once 'conexao.php';

$nome = $_SESSION['nome_usuario'] ?? null;
$email = $_SESSION['email'];

if (str_ends_with($email, '@lojaexemplo.com')) {
    $tabela = 'tb_adm';
    $nome_col = 'adm_nome';
    $email_col = 'adm_email';
    $senha_col = 'amd_senha'; // conferir se é "amd_senha" mesmo
} else {
    $tabela = 'tb_usuario';
    $nome_col = 'usuarios_nome';
    $email_col = 'usuarios_email';
    $senha_col = 'usuarios_senha';
}
if ($email !== null) {

  $sql = "SELECT * FROM $tabela WHERE $email_col = ?";
  
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "s", $email);
  mysqli_stmt_execute($comando);

  $resultado = mysqli_stmt_get_result($comando);
  $resposta = mysqli_fetch_assoc($resultado);
}
$id_col = ($tabela == 'tb_adm') ? 'idtb_adm' : 'idtb_usuario';
$id        = $resposta[$id_col];
$nome      = $resposta[$nome_col];
$email     = $resposta[$email_col];
$senhaHash = $resposta[$senha_col];


$_SESSION['email'] = $email;
$_SESSION['nome'] = $nome;
$_SESSION['id'] = $id;
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Página do Perfil</title>
  <!-- Link para o arquivo CSS que criaremos -->
  <link rel="stylesheet" href="pagina.css" />
  <!-- Ícones Ionicons para um visual moderno -->
  <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet" />
</head>

<body>

  <header class="main-header">

    <h1 class="logo">Play Zone</h1>
    <nav class="profile-nav">
      <p class="nome_do_usuario">
        <?php
        echo $_SESSION['nome_usuario'];
        ?>
      </p>
      <div class="profile-picture" id="profileToggle">
        <ion-icon name="person-circle-outline"><img src="perfil.jpg" alt=""></ion-icon>
        <!-- Ou uma imagem: <img src="caminho/para/sua/foto.jpg" alt="Foto de Perfil"> -->
      </div>
      <div class="profile-menu" id="profileMenu">
        <a href="carrinho.php" class="">
          <ion-icon name=""></ion-icon> Carrinho
        </a>
        <a href="#" class="menu-item">
          <ion-icon name="settings-outline"></ion-icon> Configurações
        </a>
        <a href="excluir_conta.php?id=<?php echo $id?>" class="menu-item delete-account">
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

  <!-- esse main pode editar o conteudo de dentro -->
  <main class="content">
    <h1>Bem-vindo(a) ao seu perfil!</h1>
    <p>Este é o conteúdo principal da sua página.</p>
    <p>Aqui você pode exibir informações do usuário, posts, etc.</p>
  </main>
  <select value="catego
  rias">

    <option><a href=""></a></option>
    <option><a></a></option>
    <option><a></a></option>
    <option><a></a></option>
    <option><a></a></option>

  </select> <br>
  <a href="form_jogos.php">adicionar jogo</a> <br>
  <a href="form_categoria.php">adicionar categoria</a> <br>
  <a href="listagemcrud.php">listagem geral</a>

  <a href="form_pagamento.php" rolo="button">
    <button>Comprar</button>
  </a>
  <!-- Script para controlar a visibilidade do menu  -->
  <script src="script.js"> </script>

</body>

</html>