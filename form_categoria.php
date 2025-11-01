<?php
require_once "conexao.php";

// Inicializar variáveis padrão
$id = 0;
$nome = "";
$descricao = "";

// Se vier id por GET, buscar os dados da categoria
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM categoria WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $categoria = mysqli_fetch_assoc($resultado);

    if ($categoria) {
        $nome = $categoria['nome'];
        $descricao = $categoria['descricao'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $id ? "Editar Categoria" : "Adicionar Categoria"; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 25px 35px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type="submit"] {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="salvar_categoria.php?id=<?php echo $id; ?>" method="post">
        <h1><?php echo $id ? "Editar Categoria" : "Adicionar Categoria"; ?></h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" 
               value="<?php echo htmlspecialchars($nome); ?>" required><br><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" 
               value="<?php echo htmlspecialchars($descricao); ?>"><br><br>

        <input type="submit" value="Salvar">
    </form>
</body>
</html>
