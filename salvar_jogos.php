<?php
require_once "conexao.php";

$id         = $_GET['id'] ?? 0;
$nome       = $_POST['nome'] ?? '';
$descricao  = $_POST['descricao'] ?? '';
$preco      = $_POST['preco'] ?? '';
$estoque    = $_POST['estoque'] ?? '';
$plataforma = $_POST['plataforma'] ?? '';
$categoria  = $_POST['categoria_id'] ?? '';
$novo_nome  = null;

// Converte categoria vazia em NULL
$categoria = !empty($categoria) ? (int)$categoria : null;

// Upload da foto
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $arquivo_tmp = $_FILES['foto']['tmp_name'];
    $arquivo_nome = $_FILES['foto']['name'];
    $extensao = pathinfo($arquivo_nome, PATHINFO_EXTENSION);
    $novo_nome = uniqid() . '.' . $extensao;
    $caminho_destino = 'fotos/' . $novo_nome;
    move_uploaded_file($arquivo_tmp, $caminho_destino);
}

if ($id == 0) {
    // Inserir novo jogo
    $sql = "INSERT INTO tb_jogos 
            (titulo, descricao, preco, foto, estoque, plataforma, categoria_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ssdsssi', $nome, $descricao, $preco, $novo_nome, $estoque, $plataforma, $categoria);
} else {
    // Atualizar jogo existente
    if ($novo_nome) {
        $sql = "UPDATE tb_jogos SET 
                    titulo = ?, 
                    descricao = ?, 
                    preco = ?, 
                    foto = ?, 
                    estoque = ?, 
                    plataforma = ?, 
                    categoria_id = ? 
                WHERE id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'ssdsssii', $nome, $descricao, $preco, $novo_nome, $estoque, $plataforma, $categoria, $id);
    } else {
        $sql = "UPDATE tb_jogos SET 
                    titulo = ?, 
                    descricao = ?, 
                    preco = ?, 
                    estoque = ?, 
                    plataforma = ?, 
                    categoria_id = ? 
                WHERE id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'ssdssii', $nome, $descricao, $preco, $estoque, $plataforma, $categoria, $id);
    }
}

if (mysqli_stmt_execute($comando)) {
    mysqli_stmt_close($comando);
    header("Location: pagina.php");
    exit;
} else {
    $erro = mysqli_stmt_error($comando);
    mysqli_stmt_close($comando);
    die("Erro ao salvar no banco: $erro");
}
?>
