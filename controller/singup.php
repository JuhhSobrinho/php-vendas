<?php
session_start();
include('./model/conexao.php');


if (empty($_POST['User']) || empty($_POST['Pass'])) {
    header('Location: ./index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['User']);
$senha = mysqli_real_escape_string($conexao, $_POST['Pass']);

// Verifica se o usuário já existe
$query_verifica = "SELECT cod FROM usuario WHERE nomeUser = ?";
$stmt_verifica = mysqli_prepare($conexao, $query_verifica);
mysqli_stmt_bind_param($stmt_verifica, 's', $usuario);
mysqli_stmt_execute($stmt_verifica);
mysqli_stmt_store_result($stmt_verifica);

if (mysqli_stmt_num_rows($stmt_verifica) > 0) {
    // Usuário já existe, redirecione para página de cadastro com mensagem de erro
    header('Location: cadastrar_usuario.php?erro=usuario_existente');
    exit();
}

// Se o usuário não existe, insere o novo usuário
$hashed_senha = password_hash($senha, PASSWORD_DEFAULT);
$query_insere = "INSERT INTO usuario (nomeUser, nomeSenha) VALUES (?, ?)";
$stmt_insere = mysqli_prepare($conexao, $query_insere);
mysqli_stmt_bind_param($stmt_insere, 'ss', $usuario, $hashed_senha);

if (mysqli_stmt_execute($stmt_insere)) {
    // Inserção bem-sucedida, redirecione para a página de login ou outra página desejada
    header('Location: ./view/menu.php');
    exit();
} else {
    // Erro na inserção, redirecione para a página de cadastro com mensagem de erro
    header('Location: ./index.php');
    exit();
}

?>