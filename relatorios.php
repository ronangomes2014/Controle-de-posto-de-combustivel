<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

function gerarRelatorioCompras() {
    $compras = file("compras.csv");
    $combustiveis = file("combustiveis.csv");

    echo "<h2>Relatório de Compras de Combustível</h2>";
    echo "<table border='1'>
            <tr>
                <th>Combustível</th>
                <th>Quantidade Comprada (litros)</th>
                <th>Data da Compra</th>
            </tr>";

    foreach ($compras as $compra) {
        $dados_compra = explode(",", $compra);
        $combustivel_id = $dados_compra[1];
        $quantidade = $dados_compra[2];
        $data = $dados_compra[3];

        $combustivel_info = explode(",", $combustiveis[$combustivel_id]);
        echo "<tr>";
        echo "<td>" . $combustivel_info[1] . "</td>";
        echo "<td>" . $quantidade . "</td>";
        echo "<td>" . $data . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relatórios</title>
</head>
<body>
    <h1>Relatórios</h1>
    <?php gerarRelatorioCompras(); ?>
    <br>
    <a href="estoque.php">Voltar</a>
</body>
</html>
