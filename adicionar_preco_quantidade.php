<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

if(isset($_POST['combustivel_id'], $_POST['quantidade'], $_POST['preco'])){
    $combustivel_id = $_POST['combustivel_id'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // Atualizar o combustível no arquivo CSV
    $linhas = file("combustiveis.csv");
    $linhas[$combustivel_id] = str_replace($linhas[$combustivel_id], "$combustivel_id,$linhas[$combustivel_id],$quantidade,$preco\n", $linhas[$combustivel_id]);
    file_put_contents("combustiveis.csv", implode("", $linhas));

    header('Location: estoque.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Preço e Quantidade de Combustível</title>
</head>
<body>
    <h1>Adicionar Preço e Quantidade de Combustível</h1>
    <form action="adicionar_preco_quantidade.php" method="post">
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
        <label for="quantidade">Quantidade:</label>
        <input type="text" id="quantidade" name="quantidade"><br>
        <label for="preco">Preço (R$ por litro):</label>
        <input type="text" id="preco" name="preco"><br>
        <input type="submit" value="Adicionar Preço e Quantidade">
    </form>
</body>
</html>
