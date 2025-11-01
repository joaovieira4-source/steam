<?php
// Inicia a sessão para acessar o ID do usuário
session_start(); 

// Inclui o arquivo de conexão
require_once "conexao.php"; 

// 1. Verificação de Segurança e Captura de Dados
// Se o usuário não estiver logado, redireciona para o login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: pagina.php"); // Redireciona para a página de login
    exit();
}

// Obtém o ID do usuário logado
$usuarios_id_usuarios = $_SESSION['id_usuario'];

// Captura os dados do formulário via GET
$data_pagamento = $_GET['data'] ?? null;
$forma_pagamento = $_GET['pagamento'] ?? null;

// !!! ATENÇÃO: O VALOR DO PAGAMENTO NÃO ESTÁ NO SEU FORMULÁRIO.
// Você PRECISA buscá-lo do carrinho ou da tabela de venda/pedido.
// Para este exemplo, vou usar um valor simbólico, mas você deve buscar o real.
$valor_pagamento = 199.99; // <--- Substitua esta linha pela lógica real do seu sistema

// Validação simples dos dados
if (!$data_pagamento || !$forma_pagamento) {
    die("Erro: Data ou Forma de Pagamento não fornecidas.");
}

// 2. Montagem da Query SQL (Corrigida)
// A tabela 'pagamento' possui 4 colunas: 
// id_pagamento (AUTO_INCREMENT), forma_pagamento, data_pagamento, usuarios_id_usuarios
// A query precisa ter 3 '?' para os valores que não são o AUTO_INCREMENT.

$sql = "INSERT INTO pagamento (forma_pagamento, data_pagamento, usuarios_id_usuarios) VALUES (?, ?, ?)";
$comando = mysqli_prepare($conexao, $sql);

// 3. Bind dos Parâmetros
// Tipos esperados:
// s: string (forma_pagamento)
// s: string (data_pagamento)
// i: integer (usuarios_id_usuarios)
mysqli_stmt_bind_param($comando, "ssi", 
    $forma_pagamento,         // 1º '?'
    $data_pagamento,          // 2º '?'
    $usuarios_id_usuarios     // 3º '?'
);

// 4. Execução e Fechamento
if (mysqli_stmt_execute($comando)) {
    // Sucesso
    header("Location: confirmacao.html"); // Redireciona para uma página de sucesso
} else {
    // Erro na execução
    echo "Erro ao salvar o pagamento: " . mysqli_error($conexao);
}

mysqli_stmt_close($comando);
mysqli_close($conexao);

?>