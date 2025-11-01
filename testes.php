<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- isso aqui usa a tabela categorias, porem não salva no banco  !-->
    Categoria: <br>
        <select name="categoria" value="<?php echo $categoria ?>"> <br>
            <?php
                require_once "conexao.php";

                $sql= "SELECT * FROM categoria";

                $comando = mysqli_prepare($conexao, $sql);
                mysqli_stmt_execute($comando);
                $resultados = mysqli_stmt_get_result($comando);

                while ($categoria = mysqli_fetch_assoc($resultados)) {
                    $nome = $categoria['categoria_nome'];
                    $id = $categoria['id_descricao'];

                    echo "<option value='$id'>$nome</option>";
                } 
            ?>  
</body>
</html>
 
<?php
    require_once "conexao.php";

    $sql= "SELECT * FROM tb_usuarios";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);
   
    while ($usuarios = mysqli_fetch_assoc($resultados)) {
           
            $id = $usuarios['id_usuarios'];
            $email = $usuarios['usuarios_email'];
    }

    if (str_ends_with($email, '@gmail.com')){

        $sql= "DELETE FROM tb_usuarios WHERE id_usuarios = ?"; 

        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, "i", $id);

        mysqli_stmt_execute($comando);
    }
    elseif(str_ends_with($email, '@lojaexemplo.com')){
         $sql= "DELETE FROM tb_adm WHERE idtb_adm = ?";

        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, "i", $id);

        mysqli_stmt_execute($comando);
    }
    header("Location: index.php");
    

?>

<!-- codigo antigo do salvar_pagamento !-->
<?php
session_start();
require_once "conexao.php";

    if(!isset($_SESSION['id_usuario'])){
        header("Location: index.php");
    }

$data = $_GET['data'];
$forma_pagamento = $_GET['pagamento'];
$usuarios_id_usuarios = $_SESSION['id_usuario'];


$sql = "INSERT INTO pagamento VALUES (?, ?, ?)";
$comando = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($comando, "ssi", $data, $forma_pagamento, $usuarios_id_usuarios);

mysqli_stmt_execute($comando);

mysqli_stmt_close($comando);

header("Location: pagina.html");

?>
<!-- codigo antigo do form_pagamento !-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
</head>
<body>

<h2>Forma de Pagamento</h2>

<form action="salvar_pagamento.php">
    <h2>data do pagamento</h2>
    <input type="date" name="data" >

    <select name="pagamento" >
        <option value="">Selecione...</option>
        <option value="pix">Pix</option>
        <option value="credito">Cartão de Crédito</option>
        <option value="debito">Cartão de Débito</option>
        <option value="boleto">Boleto Bancário</option>
    </select>

    <input type="submit" value="Confirmar Pagamento">
</form>

</body>
</html>
<!-- codigo antigo do listar -->
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

           echo "<table border='1'>";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Foto</td>";
        echo "<td>Nome</td>";
        echo "<td>Descrição</td>";
        echo "<td>Preço</td>";
        echo "<td>Estoque</td>";
        echo "<td>Plataforma</td>";
        echo "<td>Categoria</td>";
        echo "<td>Editar</td>";
        echo "<td>Excluir</td>";
        echo "</tr>";

        while ($jogos = mysqli_fetch_assoc($resultados)) {
            $id = $jogos['id_jogos'];
            $nome = $jogos['jogos_titulo'];
            $descricao = $jogos['jogos_descricao'];
            $preco = $jogos['jogos_preco'];
            $foto= $jogos['foto'];
            $estoque= $jogos['jogos_estoque'];
            $plataforma= $jogos['jogos_plataforma'];
            $categoria= $jogos['jogos_categoria'];

            echo "<tr>";
            echo "<td>$id</td>";
            echo"<td><img src='fotos/$foto'></td>";
            echo "<td>$nome</td>";
            echo "<td>$descricao</td>";
            echo "<td>$preco</td>";
            echo "<td>$estoque</td>";
            echo "<td>$plataforma</td>";
            echo "<td><a href='form_jogos.php?id=$id'>editar</a></td>";
            echo "<td><a href='deletar_jogos.php?id=$id'><img src='delete.png'></a></td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_stmt_close($comando);    
    ?>
</body>
</html>


<?php
$hash = password_hash("admin123", PASSWORD_DEFAULT);

echo $hash;
?>