<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Controle de Estoque</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['nome']; ?></h1>
    <h2>Estoque de Combustível</h2>
    <table border="1">
        <tr>
            <th>Combustível</th>
            <th>Quantidade</th>
            <th>Preço (R$)</th>
        </tr>
        <?php
        $handle = fopen("combustiveis.csv", "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
            echo "<tr>";
            echo "<td>" . $data[1] . "</td>";
            echo "<td>" . $data[2] . "</td>";
            echo "<td>" . $data[3] . "</td>";
            echo "</tr>";
        }
        fclose($handle);
        ?>
    </table>
    <a href="adicionar_preco_quantidade.php">Adicionar Preço e Quantidade de Combustível</a><br>
    <a href="registrar_compra.php">Registrar Compra de Combustível</a><br>
    <a href="relatorios.php">Gerar Relatórios</a><br>
    <a href="logout.php">Sair</a>
</body>
</html>
