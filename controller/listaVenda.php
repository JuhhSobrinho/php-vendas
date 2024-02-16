<?php 
$vendedor = mysqli_real_escape_string($conexao, $_SESSION['idUser']);
$query_seleciona_produtos = "SELECT cod, nomeProduto, price FROM produtos WHERE vendedor = '$vendedor'";
$result_produtos = mysqli_query($conexao, $query_seleciona_produtos);

while ($row = mysqli_fetch_assoc($result_produtos)) {
    echo '<form class="card-compra"  method="POST" action="../view/processaVendas.php">';
    echo '<input type="hidden" name="Cod" value="' . htmlspecialchars($row['cod']) . '">';
    echo '<lord-icon src="https://cdn.lordicon.com/ofwxettw.json" trigger="loop" delay="2000" colors="primary:#ffffff,secondary:#4f1091" style="width:70px;height:70px">';
    echo '</lord-icon>';
    echo '<p></p>';
    echo '<input class="dadosProduto"  type="text" name="Produto" value="' . htmlspecialchars($row['nomeProduto']) . '">';
    echo '<input class="dadosProduto"  type="text" pattern="\d+(\.\d{1,2})?" name="Price" value="' . htmlspecialchars($row['price']) . '" />';
    echo '<p></p>';
    echo '<div class="botoes-vendas">';
    echo    '<input type="submit" name="Submit" value="Atualizar">';
    echo    '<input type="submit" name="Submit" value="Deletar">';
    echo    '<input type="hidden" name="action" id="action" value="">    ';
    echo '</div>';
    echo '</form>';
}
?>
