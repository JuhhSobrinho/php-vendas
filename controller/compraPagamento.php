<?php
include(__DIR__ . '../../verifica.php');
include(__DIR__ . '../../model/conexao.php');

if (empty($_POST['Cod']) || empty($_POST['Produto']) || empty($_POST['Price'])) {
    header('Location: ../index.php');
    exit();
}

$cod = mysqli_real_escape_string($conexao, $_POST['Cod']);
$produto = mysqli_real_escape_string($conexao, $_POST['Produto']);
$price = mysqli_real_escape_string($conexao, $_POST['Price']);
$comprador = mysqli_real_escape_string($conexao, $_SESSION['usuario']);


$query_vendedor = "SELECT nomeUser FROM usuario WHERE cod = ?";
$stmt_vendedor = mysqli_prepare($conexao, $query_vendedor);
mysqli_stmt_bind_param($stmt_vendedor, 'i', $cod);
mysqli_stmt_execute($stmt_vendedor);
mysqli_stmt_store_result($stmt_vendedor);

if (mysqli_stmt_num_rows($stmt_vendedor) > 0) {
    // Associe o resultado à variável $nome_do_vendedor
    mysqli_stmt_bind_result($stmt_vendedor, $nome_do_vendedor);
    mysqli_stmt_fetch($stmt_vendedor);

    echo '<link rel="Stylesheet" href="../css/StyleM.css">';
    echo    '<script src="https://cdn.lordicon.com/lordicon.js"></script>';
    echo    '<form class="card" id="card-pagamento" method="POST" action="../controller/newProduto.php">';
    echo    '<lord-icon src="https://cdn.lordicon.com/ofwxettw.json" trigger="loop" delay="2000" colors="primary:#ffffff,secondary:#4f1091" style="width:120px;height:120px">';
    echo    '</lord-icon><div id="seuElemento"></div>';
    echo    '<div class="card-parcela"><p></p>';
    echo    '<section class="card-dados-pagamento">';
    echo    '<span class="titulo-dados-pagamento">Nome do Produto:</span>';
    echo   '<input type="text" readonly name="Produto" value="'  . htmlspecialchars($produto) . '">';
    echo    '<span class="titulo-dados-pagamento">Preço:</span>';
    echo    '<input type="text" id="price-inicial" readonly pattern="\d+(\.\d{1,2})?" name="Price"value="'  . htmlspecialchars($price) . '" />';
    echo    '<span class="titulo-dados-pagamento">Vendedor:</span>';
    echo '<input type="text" readonly id="nome-cliente" style="display: none" name="comprador" value="'. htmlspecialchars($comprador) .'">';
    echo '<input type="text" readonly id="nome-vendedor" name="Vendedor" value="' . htmlspecialchars($nome_do_vendedor) . '">';
    echo    '</section>';
    echo    '<section class="card-dados-parcela">';
    echo    '<span class="titulo-dados-pagamento">Metodo de Pagamento</span>';
    echo    '<div class="botoes">';
    echo        '<input class="btn" id="btn-debito" type="button" name="button" value="Debito">';
    echo        '<input class="btn" id="btn-credito" type="button" name="button" value="Credito">';
    echo        '<input class="btn" id="btn-pix" type="button" name="button" value="Pix">';
    echo    '</div>';    
    echo    '<span class="titulo-dados-pagamento">Preço a pagar por mes:</span>';
    echo    '<div class="botoes">';
    echo    '<input type="number" id="input-parcela" name="parcela" placeholder="até 12x"/>';
    echo    '<input type="text" id="text-parcela" readonly name="Price"value="'  . htmlspecialchars($price) . '" />';
    echo    '</div>';  
    echo    '</section>';
    echo '<p></p></div>';
    echo    '<div class="botoes">';
    echo        '<input class="btn" id="finalizar-compra" type="button" name="button" value="Finalizar Compra">';
    echo    '</div>';
    echo    '</form>';
    echo '<script type="module" src="./gerarPagamento.js"></script>';

} else {
    // Trate a situação em que nenhum resultado foi encontrado
    echo '<input type="text" readonly name="Vendedor" value="Vendedor não encontrado">';
}
