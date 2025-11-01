<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            height: 50px;
            width: 50px;
        }
    </style>
</head>
<body>
    <h2>Lista de jogos</h2>
    <a href="pagina.php">voltar</a> <br>
    <?php
        require_once "conexao.php";
        
        $sql= "SELECT * FROM tb_jogos";
        $comando= mysqli_prepare($conexao, $sql);

        mysqli_stmt_execute($comando);

        $resultados= mysqli_stmt_get_result($comando);

           echo "<div >";


        while ($jogos = mysqli_fetch_assoc($resultados)) {
            $id = $jogos['id'];
            $nome = $jogos['titulo'];
            $descricao = $jogos['descricao'];
            $preco = $jogos['preco'];
            $foto= $jogos['foto'];
            $estoque= $jogos['estoque'];
            $plataforma= $jogos['plataforma'];
            $categoria= $jogos['categoria'];

            echo "<img src='fotos/$foto'>";
            echo "<h3>$nome</h3>";
            echo "<p>$categoria</p>";
            echo $preco;

        }
        echo "</div>";

        mysqli_stmt_close($comando);    
    ?>

</body>
</html>