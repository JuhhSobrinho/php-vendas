<?php
session_start();
include('./model/conexao.php');

if (empty($_POST['User']) || empty($_POST['Pass']) || empty($_POST['action'])) {
    header('Location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['User']);
$senha = mysqli_real_escape_string($conexao, $_POST['Pass']);
$action = $_POST['action'];

// Verifica a ação a ser executada
if ($action == 'login') {
    include('./controller/login.php');
} elseif ($action == 'signup') {
    include('./controller/singup.php');

    // ...
} else {
    // Ação inválida, redireciona para a página de login
    header('Location: ./index.php');
    exit();
}
?>
