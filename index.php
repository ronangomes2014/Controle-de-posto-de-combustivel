<?php
session_start();
if(isset($_SESSION['username'])){
    header('Location: estoque.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
