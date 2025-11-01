<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
</head>
<body>

<h2>Forma de Pagamento</h2>
<form action="salvar_compra.php" method="POST"> 
    <h2>Data do Pagamento</h2>
    <input type="date" name="data" required>

    <h2>Valor da Compra</h2>
    <input type="number" name="valor" step="0.01" placeholder="Valor Total" required>

    <h2>Selecione a Forma de Pagamento</h2>
    <select name="pagamento" required>
        <option value="">Selecione...</option>
        <option value="pix">Pix</option>
        <option value="credito">Cartão de Crédito</option>
        <option value="debito">Cartão de Débito</option>
        <option value="boleto">Boleto Bancário</option>
    </select>

    <input type="submit" value="Confirmar Compra">
</form>

</body>
</html>