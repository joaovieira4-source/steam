<?php
    require_once "conexao.php";
    
    // pega as valores lá do formulário
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $ano = $_POST['ano'];
    $idautor = $_POST['autor'];

    if($id == 0){

       $sql = "INSERT INTO tb_livro (nome, genero, ano, foto, id_autor) VALUES (?, ?, ?, ?, ?)";  

       $comando = mysqli_prepare($conexao, $sql);

       mysqli_stmt_bind_param($comando, 'ssisi', $nome, $genero, $ano, $novo_nome, $idautor);
    }
    else{

        $sql = "UPDATE tb_livro SET nome = ?, genero = ?, ano = ? foto = ?, id_autor = ? WHERE idlivro = ? ";

        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, 'ssisii', $nome, $genero, $ano, $novo_nome, $idautor, $id);
    }
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];

    //pegar a extensão do arquivo
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    //gerar um novo nome
    $novo_nome = uniqid() . "." . $extensao;

    // lembre-se de criar a pasta e de ajustar as permissões.
    $caminho_destino = "fotos/" . $novo_nome;

    mysqli_stmt_close($comando);

    header("Location: index.php");
?>
