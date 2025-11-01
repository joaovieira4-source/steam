<?php
session_start();
require_once 'conexao.php';

// Verifica se o usuário está logado
$email = $_SESSION['email'] ?? null;
if (!$email) {
    header("Location: index.php");
    exit;
}

// Define a tabela (administrador ou usuário)
$tabela = str_ends_with($email, '@lojaexemplo.com') ? 'tb_adm' : 'tb_usuario';

// Busca os dados do usuário/admin
$sql = "SELECT * FROM $tabela WHERE email = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "s", $email);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
$resposta = mysqli_fetch_assoc($resultado);

// Define variáveis do usuário
$idUsuario    = $resposta['id'];
$nomeUsuario  = $resposta['nome'];
$emailUsuario = $resposta['email'];
$senhaHash    = $resposta['senha'];

// Salva na sessão
$_SESSION['id'] = $idUsuario;
$_SESSION['nome_usuario'] = $nomeUsuario;
$_SESSION['email'] = $emailUsuario;

// Busca todos os jogos
$sqlJogos = "SELECT * FROM tb_jogos";
$comandoJogos = mysqli_prepare($conexao, $sqlJogos);
mysqli_stmt_execute($comandoJogos);
$resultadosJogos = mysqli_stmt_get_result($comandoJogos);

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Perfil</title>
    <link rel="stylesheet" href="pagina.css">
    <link href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css" rel="stylesheet">
</head>

<body>

    <!-- Header / Menu de perfil -->
    <header class="main-header">
        <h1 class="logo">Play Zone</h1>
        <nav class="profile-nav">
            <p class="nome_do_usuario"><?php echo htmlspecialchars($nomeUsuario); ?></p>
            <div class="profile-picture" id="profileToggle">
                <ion-icon name="person-circle-outline">
                    <img src="perfil.jpg" alt="Perfil">
                </ion-icon>
            </div>
            <div class="profile-menu" id="profileMenu">
                <a href="jogos.php?id=<?php echo $idUsuario;?>" class="menu-item">
                    <ion-icon name="cart-outline"></ion-icon> Meus Jogos
                </a>
                <a href="#" class="menu-item">
                    <ion-icon name="settings-outline"></ion-icon> Configurações
                </a>
                <a href="excluir_conta.php?id=<?php echo $idUsuario; ?>" class="menu-item delete-account">
                    <ion-icon name="trash-outline"></ion-icon> Excluir Conta
                </a>
                <a href="logout.php" class="menu-item logout">
                    <ion-icon name="log-out-outline"></ion-icon> Sair
                </a>
            </div>
        </nav>
    </header>

    <!-- Toggle de modo -->
    <div class="toggle-container" style="justify-items: end;">
        <label class="switch">
            <input type="checkbox" id="modeToggle">
            <span class="slider"></span>
        </label>
        <span id="toggleLabel">OFF</span>
    </div>

    <!-- Conteúdo principal -->
    <main class="content">
        <h1>Bem-vindo(a) ao seu perfil!</h1>
        <p>Este é o conteúdo principal da sua página.</p>
        <p>Aqui você pode exibir informações do usuário, posts, etc.</p>

        <!-- Links para CRUD / Compra -->
        <div class="links-crud">
            <?php
            if ($tabela === "tb_adm") {
                echo '<a href="form_jogos.php">Adicionar Jogo</a><br>';
                echo '<a href="form_categoria.php">Adicionar Categoria</a><br>';
                echo '<a href="listagemcrud.php">Listagem Geral</a><br>';
            } else {
                echo '<a href="listagemcrud.php">Listagem Geral</a><br>';
                echo '<a href="form_pagamento.php"><button>Comprar</button></a>';
            }
            ?>
        </div>

        <!-- Lista de Jogos -->
        <div class="jogos-lista">
            <?php
            while ($jogo = mysqli_fetch_assoc($resultadosJogos)) {
                $idJogo        = $jogo['id'];
                $tituloJogo    = htmlspecialchars($jogo['titulo']);
                $descricaoJogo = htmlspecialchars($jogo['descricao']);
                $precoJogo     = htmlspecialchars($jogo['preco']);
                $fotoJogo      = htmlspecialchars($jogo['foto']);
                $categoriaJogo = htmlspecialchars($jogo['categoria'] ?? 'Não especificada');

                echo "<div class='jogo-item'>
            <img src='fotos/$fotoJogo' alt='$tituloJogo'>
            <h3>$tituloJogo</h3>
            <p>Categoria: $categoriaJogo</p>
            <p>Preço: $precoJogo</p>
            <form action='salvarUsuarioJogos.php' method='post'>
                <input type='hidden' name='idusuario' value='$idUsuario'>
                <input type='hidden' name='idjogo' value='$idJogo'>
                <input type='hidden' name='data' value='" . date("Y-m-d") . "'>
                <button type='submit'>Comprar</button>
            </form>
          </div>";
            }
            ?>
        </div>
    </main>

    <script src="script.js"></script>
</body>

</html>