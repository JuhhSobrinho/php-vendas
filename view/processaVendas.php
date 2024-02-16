<?php
session_start();
include(__DIR__ . '../../model/conexao.php');

if (empty($_POST['Cod']) || empty($_POST['Produto']) || empty($_POST['Price']) || empty($_POST['action'])) {
    header('Location: ../index.php');
    exit();
}

$cod = mysqli_real_escape_string($conexao, $_POST['Cod']);
$produto = mysqli_real_escape_string($conexao, $_POST['Produto']);
$price = mysqli_real_escape_string($conexao, $_POST['Price']);
$vendedor = mysqli_real_escape_string($conexao, $_SESSION['usuario']);

$action = $_POST['action'];

// Verifica a ação a ser executada
if ($action == 'Atualizar') {
    include('../controller/atualizarProduto.php');
} elseif ($action == 'Deletar') {
    include('../controller/deletarProduto.php');
} else {
    // Ação inválida, redireciona para a página de login
    header('Location: ./menu.php');
    exit();
}

?>
