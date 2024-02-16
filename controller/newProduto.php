<?php
session_start();
include(__DIR__ . '../../model/conexao.php');


if (empty($_POST['Produto']) || empty($_POST['Price'])) {
    header('Location: ./index.php');
    exit();
}

$produto = mysqli_real_escape_string($conexao, $_POST['Produto']);
$Price = mysqli_real_escape_string($conexao, $_POST['Price']);
$vendedor = mysqli_real_escape_string($conexao, $_SESSION['idUser']);



// Se o usuário não existe, insere o novo usuário

$query_insere = "INSERT INTO produtos (nomeProduto, price, vendedor) VALUES (?, ?, ?)";
$stmt_insere = mysqli_prepare($conexao, $query_insere);
mysqli_stmt_bind_param($stmt_insere, 'sss', $produto, $Price, $vendedor);

if (mysqli_stmt_execute($stmt_insere)) {
    // Inserção bem-sucedida, redirecione para a página de login ou outra página desejada
    header('Location: ../view/menu.php');
    exit();
} else {
    // Erro na inserção, redirecione para a página de cadastro com mensagem de erro
    header('Location: ./index.php');
    exit();
}

?>