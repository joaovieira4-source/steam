<?php
include_once 'conexao.php'; // Inclui o arquivo de conexão

$categoria_selecionada = $_GET['categoria_id'] ?? null; // Pega o ID da categoria da URL

// --- 1. Buscar todas as categorias para o filtro ---
$sql_categorias = "SELECT id_categoria, categoria_nome FROM categoria ORDER BY categoria_nome";
$resultado_categorias = $conn->query($sql_categorias);

// --- 2. Buscar os jogos ---
// A tabela tb_jogos usa a coluna jogos_categoria como VARCHAR para o nome da categoria.
// Uma JOIN com a tabela categoria seria mais robusta se tb_jogos tivesse a FK id_categoria.
// Assumindo que jogos_categoria em tb_jogos armazena o mesmo texto de categoria_nome em categoria:

$sql_jogos = "SELECT 
                j.jogos_titulo, 
                j.jogos_descricao, 
                j.jogos_preco, 
                j.jogos_plataforma, 
                j.jogos_estoque,
                c.categoria_nome
              FROM tb_jogos j
              JOIN categoria c ON j.jogos_categoria = c.categoria_nome"; // Faz a ligação pelo nome

if ($categoria_selecionada) {
    // Se uma categoria foi selecionada, adiciona a cláusula WHERE
    // Usaremos um parâmetro seguro (prepared statement) para evitar SQL Injection
    // Mas para manter a simplicidade, farei a consulta com base no ID da categoria na tabela 'categoria' e comparando os nomes
    
    // Recupera o nome da categoria pelo ID selecionado (para a cláusula WHERE)
    $stmt_nome = $conn->prepare("SELECT categoria_nome FROM categoria WHERE id_categoria = ?");
    $stmt_nome->bind_param("i", $categoria_selecionada);
    $stmt_nome->execute();
    $result_nome = $stmt_nome->get_result();
    
    if ($result_nome->num_rows > 0) {
        $row_nome = $result_nome->fetch_assoc();
        $nome_categoria_filtro = $row_nome['categoria_nome'];
        
        // Adiciona a cláusula WHERE filtrando pelo nome da categoria (que está em tb_jogos)
        $sql_jogos .= " WHERE c.categoria_nome = ?";
        
        // Finaliza a primeira busca de nome e prepara a busca de jogos
        $stmt_nome->close();
        
        $stmt_jogos = $conn->prepare($sql_jogos);
        $stmt_jogos->bind_param("s", $nome_categoria_filtro);
        $stmt_jogos->execute();
        $resultado_jogos = $stmt_jogos->get_result();
    } else {
         // Categoria não encontrada, lista todos os jogos
        $resultado_jogos = $conn->query($sql_jogos);
        $categoria_selecionada = null; // Reseta o filtro para não dar erro
    }
} else {
    // Lista todos os jogos se nenhuma categoria foi selecionada
    $resultado_jogos = $conn->query($sql_jogos);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Jogos por Categoria</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .filtro { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px; }
        select, button { padding: 10px; margin-right: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1>🕹️ Listagem de Jogos</h1>

    <div class="filtro">
        <form method="GET" action="listar_jogos.php">
            <label for="categoria_id">Filtrar por Categoria:</label>
            <select name="categoria_id" id="categoria_id">
                <option value="">-- Todas as Categorias --</option>
                <?php
                if ($resultado_categorias->num_rows > 0) {
                    while($row = $resultado_categorias->fetch_assoc()) {
                        // Marca a categoria selecionada como 'selected' no dropdown
                        $selected = ($categoria_selecionada == $row['id_categoria']) ? 'selected' : '';
                        echo "<option value='{$row['id_categoria']}' {$selected}>{$row['categoria_nome']}</option>";
                    }
                }
                ?>
            </select>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <?php if ($resultado_jogos && $resultado_jogos->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Plataforma</th>
                <th>Estoque</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php while($jogo = $resultado_jogos->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($jogo['jogos_titulo']) ?></td>
                <td><?= htmlspecialchars($jogo['jogos_descricao']) ?></td>
                <td>R$ <?= htmlspecialchars($jogo['jogos_preco']) ?></td>
                <td><?= htmlspecialchars($jogo['jogos_plataforma'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($jogo['jogos_estoque']) ?></td>
                <td><?= htmlspecialchars($jogo['categoria_nome']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Nenhum jogo encontrado na categoria selecionada ou o banco de dados está vazio.</p>
    <?php endif; ?>

</div>

<?php 
// Fecha as conexões e libera os resultados
if(isset($stmt_jogos)) $stmt_jogos->close(); 
$conn->close(); 
?>

</body>
</html>