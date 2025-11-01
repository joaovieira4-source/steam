<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Pagamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            border: none;
            margin-top: 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <form action="salvar_compra.php" method="POST">
        <h2>Registrar Pagamento</h2>

        <label for="data">Data do Pagamento:</label>
        <input type="date" name="data" id="data" required>

        <label for="forma">Forma de Pagamento:</label>
        <select name="forma" id="forma" required>
            <option value="">Selecione...</option>
            <option value="Pix">Pix</option>
            <option value="Crédito">Cartão de Crédito</option>
            <option value="Débito">Cartão de Débito</option>
            <option value="Boleto">Boleto Bancário</option>
        </select>

        <label for="usuario_id">Usuário:</label>
        <select name="usuario_id" id="usuario_id" required>
            <!-- Este SELECT será preenchido dinamicamente com usuários do banco -->
            <?php
            include("conexao.php");
            $sql = "SELECT id, nome FROM tb_usuario";
            $resultado = $conexao->query($sql);

            while ($linha = $resultado->fetch_assoc()) {
                echo "<option value='{$linha['id']}'>{$linha['nome']}</option>";
            }

            $conexao->close();
            ?>
        </select>

        <input type="submit" value="Confirmar Pagamento">
    </form>

</body>
</html>
