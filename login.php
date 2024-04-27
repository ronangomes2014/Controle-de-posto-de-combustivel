<?php
session_start();
if(isset($_SESSION['username'])){
    header('Location: estoque.php');
    exit();
}

if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $handle = fopen("usuarios.csv", "r");
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[1] == $username && $data[2] == $password) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $data[0];
            $_SESSION['nome'] = $data[3];
            header('Location: estoque.php');
            exit();
        }
    }
    fclose($handle);

    echo "Login inválido!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
