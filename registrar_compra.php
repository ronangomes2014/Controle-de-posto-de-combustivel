<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

if(isset($_POST['combustivel_id'], $_POST['quantidade'])){
    $combustivel_id = $_POST['combustivel_id'];
    $quantidade = $_POST['quantidade'];

    // Registrar a compra no arquivo CSV
    $compra = [count(file("compras.csv")), $combustivel_id, $quantidade, date("Y-m-d")];
    file_put_contents("compras.csv", implode(",", $compra) . "\n", FILE_APPEND);

    // Atualizar o estoque
    $linhas = file("combustiveis.csv");
    $linhas[$combustivel_id] = str_replace($linhas[$combustivel_id], "$combustivel_id," . ($linhas[$combustivel_id] + $quantidade) . "\n", $linhas[$combustivel_id]);
    file_put_contents("combustiveis.csv", implode("", $linhas));

    header('Location: estoque.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Compra de Combustível</title>
</head>
<body>
    <h1>Registrar Compra de Combustível</h1>
    <form action="registrar_compra.php" method="post">
        <label for="combustivel_id">Combustível:</label>
        <select id="combustivel_id" name="combustivel_id">
            <?php
            $handle = fopen("combustiveis.csv", "r");
            while (($data = fgetcsv($handle)) !== FALSE) {
                echo "<option value='" . $data[0] . "'>" . $data[1] . "</option>";
            }
            fclose($handle);
            ?>
        </select><br>
        <label for="quantidade">Quantidade (litros):</label>
        <input type="text" id="quantidade" name="quantidade"><br>
        <input type="submit" value="Registrar Compra">
    </form>
</body>
</html>
