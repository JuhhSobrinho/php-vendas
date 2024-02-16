<?php 
include(__DIR__ . '../../model/conexao.php');


$query_seleciona_produtos = "SELECT nomeProduto, price, vendedor FROM produtos";
$result_produtos = mysqli_query($conexao, $query_seleciona_produtos);

while ($row = mysqli_fetch_assoc($result_produtos)) {
   echo '<form class="card-compra"  method="POST" action="../controller/compraPagamento.php">';
    echo '<input type="hidden" name="Cod" value="' . htmlspecialchars($row['vendedor']) . '">';
    echo'<lord-icon src="https://cdn.lordicon.com/ofwxettw.json" trigger="loop" delay="2000" colors="primary:#ffffff,secondary:#4f1091" style="width:70px;height:70px">';
    echo'</lord-icon>';
    echo'<p></p>';
    echo'<input class="dadosProduto" readonly  type="text" name="Produto" value="' . htmlspecialchars($row['nomeProduto']) . '">';
    echo'<input class="dadosProduto" readonly  type="text" pattern="\d+(\.\d{1,2})?" name="Price" value="' . htmlspecialchars($row['price']) . '" />';
    echo'<p></p>';
    echo'<div class="botoes-compra">';
    echo    '<input type="submit" name="Submit" value="Comprar">';
    echo'</div>';
    echo'</form>';
}



