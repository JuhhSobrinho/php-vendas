<?php
session_start();
include('./model/conexao.php');


if (empty($_POST['User']) || empty($_POST['Pass'])) {
    header('Location: ./index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['User']);
$senha = mysqli_real_escape_string($conexao, $_POST['Pass']);

$query = "SELECT cod, nomeUser, nomeSenha FROM usuario WHERE nomeUser = ? LIMIT 1";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 's', $usuario);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);


if (mysqli_stmt_num_rows($stmt) == 1) {
    mysqli_stmt_bind_result($stmt, $cod, $nomeUser, $hashedSenha);
    mysqli_stmt_fetch($stmt);

    if (password_verify($senha, $hashedSenha)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['idUser'] = $cod;
        header('Location: ./view/menu.php');
        exit();
    }
}

header('Location: ./index.php');
exit();

?>
