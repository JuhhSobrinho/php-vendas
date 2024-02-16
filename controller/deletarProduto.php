<?php

// Verifique se o produto existe antes de excluir
$query_verifica = "SELECT cod FROM produtos WHERE cod = ? AND vendedor = ?";
$stmt_verifica = mysqli_prepare($conexao, $query_verifica);
mysqli_stmt_bind_param($stmt_verifica, 'ss', $cod, $vendedor);
mysqli_stmt_execute($stmt_verifica);
mysqli_stmt_store_result($stmt_verifica);

if (mysqli_stmt_num_rows($stmt_verifica) > 0) {
    // O produto existe, então execute a exclusão
    $query_exclui = "DELETE FROM produtos WHERE cod = ? AND vendedor = ?";
    $stmt_exclui = mysqli_prepare($conexao, $query_exclui);
    mysqli_stmt_bind_param($stmt_exclui, 'ss', $cod, $vendedor);

    if (mysqli_stmt_execute($stmt_exclui)) {
        // Exclusão bem-sucedida, redirecione para a página desejada
        header('Location: ../view/menu.php');
        exit();
    } else {
        // Erro na exclusão, redirecione para a página de origem com mensagem de erro
        header('Location: ./index.php?erro=erro_na_exclusao');
        exit();
    }
} else {
    // O produto não existe, redirecione para a página de origem com mensagem de erro
    header('Location: ./index.php?erro=produto_nao_encontrado');
    exit();
}
?>
