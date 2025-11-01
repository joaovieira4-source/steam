<?php
require_once "conexao.php";

// Recebe os dados
$id        = $_POST['id'] ?? 0; // preferível vir via POST
$nome      = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$preco     = $_POST['preco'] ?? '';
$estoque   = $_POST['estoque'] ?? '';
$plataforma= $_POST['plataforma'] ?? '';
$categoria = $_POST['categoria'] ?? '';

var_dump($_POST);
// $novo_nome = null;

// // Tratar o upload de arquivo, se houver
// if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
//     $nome_arquivo     = $_FILES['foto']['name'];
//     $caminho_temporario = $_FILES['foto']['tmp_name'];

//     $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
//     $novo_nome = uniqid() . "." . $extensao;
//     $caminho_destino = "fotos/" . $novo_nome;

//     // Move o arquivo para a pasta destino
//     move_uploaded_file($caminho_temporario, $caminho_destino);
// }

// // Inserir ou atualizar
// if ($id == 0) {
//     $sql = "INSERT INTO tb_jogos 
//             (jogos_titulo, jogos_descricao, jogos_preco, foto, jogos_estoque, jogos_plataforma, jogos_categoria) 
//             VALUES (?, ?, ?, ?, ?, ?, ?)";
//     $comando = mysqli_prepare($conexao, $sql);
//     mysqli_stmt_bind_param($comando, 'sssssss', $nome, $descricao, $preco, $novo_nome, $estoque, $plataforma, $categoria);
// } else {
//     // Se não houver nova foto, não atualizar a coluna foto
//     if ($novo_nome) {
//         $sql = "UPDATE tb_jogos SET 
//                     jogos_titulo = ?, 
//                     jogos_descricao = ?, 
//                     jogos_preco = ?, 
//                     foto = ?, 
//                     jogos_estoque = ?, 
//                     jogos_plataforma = ?, 
//                     jogos_categoria = ? 
//                 WHERE id_jogos = ?";
//         $comando = mysqli_prepare($conexao, $sql);
//         mysqli_stmt_bind_param($comando, 'sssssssi', $nome, $descricao, $preco, $novo_nome, $estoque, $plataforma, $categoria, $id);
//     } else {
//         $sql = "UPDATE tb_jogos SET 
//                     jogos_titulo = ?, 
//                     jogos_descricao = ?, 
//                     jogos_preco = ?, 
//                     jogos_estoque = ?, 
//                     jogos_plataforma = ?, 
//                     jogos_categoria = ? 
//                 WHERE id_jogos = ?";
//         $comando = mysqli_prepare($conexao, $sql);
//         mysqli_stmt_bind_param($comando, 'ssssssi', $nome, $descricao, $preco, $estoque, $plataforma, $categoria, $id);
//     }
// }

// // Executa
// mysqli_stmt_execute($comando);
// mysqli_stmt_close($comando);

// // Redireciona
// header("Location: pagina.php");
// exit;
// ?>
