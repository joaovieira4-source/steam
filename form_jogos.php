<?php
require_once "conexao.php";

// Inicializar variáveis padrão
$id           = 0;
$titulo       = "";
$descricao    = "";
$preco        = "";
$foto         = "";
$estoque      = "";
$plataforma   = "";
$categoria_id = ""; // id da categoria selecionada

// Se vier id por GET, buscar os dados do jogo
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tb_jogos WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $resultados = mysqli_stmt_get_result($stmt);
    $jogo = mysqli_fetch_assoc($resultados);

    if ($jogo) {
        $titulo       = $jogo['titulo'];
        $descricao    = $jogo['descricao'];
        $preco        = $jogo['preco'];
        $foto         = $jogo['foto'];
        $estoque      = $jogo['estoque'];
        $plataforma   = $jogo['plataforma'];
        $categoria_id = $jogo['categoria_id']; // nome certo da coluna
    }
}

// Buscar categorias para o select
$sqlCat = "SELECT * FROM categoria ORDER BY nome ASC";
$stmtCat = mysqli_prepare($conexao, $sqlCat);
mysqli_stmt_execute($stmtCat);
$resultadosCat = mysqli_stmt_get_result($stmtCat);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? "Editar Jogo" : "Adicionar Jogo"; ?></title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #121212;
            color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background: #1c1c1f;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.6);
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #00b4ff;
            margin-bottom: 1.5rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.6rem;
            margin: 0.4rem 0 1rem;
            border: none;
            border-radius: 8px;
            background: #2a2a2e;
            color: #fff;
            font-size: 1rem;
        }

        input[type="file"] {
            margin-bottom: 1rem;
            color: #fff;
        }

        input[type="submit"] {
            background: #00b4ff;
            color: #fff;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background: #0098d6;
        }

        img {
            display: block;
            margin-top: 0.5rem;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>

    <form action="salvar_jogos.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <h1><?php echo $id ? "Editar Jogo" : "Adicionar Jogo"; ?></h1>

        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($titulo); ?>" required>

        <label>Descrição:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($descricao); ?>" required>

        <label>Preço:</label>
        <input type="text" name="preco" value="<?php echo htmlspecialchars($preco); ?>" required>

        <label>Estoque:</label>
        <input type="number" name="estoque" value="<?php echo htmlspecialchars($estoque); ?>" required>

        <label>Plataforma:</label>
        <input type="text" name="plataforma" value="<?php echo htmlspecialchars($plataforma); ?>">

        <label>Categoria:</label>
        <select name="categoria_id" required>
            <option value="">Selecione</option>
            <?php
            while ($cat = mysqli_fetch_assoc($resultadosCat)) {
                $selected = ($cat['id'] == $categoria_id) ? 'selected' : '';
                echo '<option value="' . $cat['id'] . '" ' . $selected . '>' 
                    . htmlspecialchars($cat['nome']) . '</option>';
            }
            ?>
        </select>

        <label>Foto:</label>
        <input type="file" name="foto">
        <?php if ($foto): ?>
            <img src="fotos/<?php echo htmlspecialchars($foto); ?>" alt="Foto do jogo" width="100">
        <?php endif; ?>

        <input type="submit" value="Salvar">
    </form>

</body>
</html>
