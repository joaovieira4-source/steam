<?php
require_once "conexao.php";

// Inicializar variáveis padrão
$id           = 0;
$nome         = "";
$descricao    = "";
$preco        = "";
$foto         = "";
$estoque      = "";
$plataforma   = "";
$categoria_id = ""; // id da categoria selecionada

// Se vier id por GET, buscar os dados do jogo
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tb_jogos WHERE id_jogos = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $resultados = mysqli_stmt_get_result($stmt);
    $jogo = mysqli_fetch_assoc($resultados);

    if ($jogo) {
        $nome         = $jogo['jogos_titulo'];
        $descricao    = $jogo['jogos_descricao'];
        $preco        = $jogo['jogos_preco'];
        $foto         = $jogo['foto'];
        $estoque      = $jogo['jogos_estoque'];
        $plataforma   = $jogo['jogos_plataforma'];
        $categoria_id = $jogo['jogos_categoria'];
    }
}

// Buscar categorias para o select
$sqlCat = "SELECT * FROM categoria"; // ajuste a tabela se necessário
$stmtCat = mysqli_prepare($conexao, $sqlCat);
mysqli_stmt_execute($stmtCat);
$resultadosCat = mysqli_stmt_get_result($stmtCat);

// Armazenar categorias em array
$categorias = [];
while ($row = mysqli_fetch_assoc($resultadosCat)) {
    $categorias[] = $row;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? "Editar Jogo" : "Adicionar Jogo"; ?></title>
</head>
<body>
    <h1><?php echo $id ? "Editar Jogo" : "Adicionar Jogo"; ?></h1>

    <form action="salvar_jogos.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        Nome: <br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>"><br><br>

        Descrição: <br>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($descricao); ?>"><br><br>

        Preço: <br>
        <input type="text" name="preco" value="<?php echo htmlspecialchars($preco); ?>"><br><br>

        Estoque: <br>
        <input type="number" name="estoque" value="<?php echo htmlspecialchars($estoque); ?>"><br><br>

        Plataforma: <br>
        <input type="text" name="plataforma" value="<?php echo htmlspecialchars($plataforma); ?>"><br><br>

        Categoria: <br>
        <select name="categoria">
            <option value="">Selecione</option>
            <?php
            foreach ($categorias as $cat) {
                $selected = ($cat['id_descricao'] == $categoria_id) ? 'selected' : '';
                echo '<option value="' . $cat['id_descricao'] . '" ' . $selected . '>' 
                    . htmlspecialchars($cat['categoria_nome']) . '</option>';
            }
            ?>
        </select><br><br>

        Foto: <br>
        <input type="file" name="foto"><br>
        <?php
        if ($foto) {
            echo '<img src="fotos/' . htmlspecialchars($foto) . '" alt="Foto do jogo" width="100">';
        }
        ?><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>
