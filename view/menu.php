<?php
include(__DIR__ . '../../verifica.php');

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <link rel="Stylesheet" href="../css/StyleM.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>

</head>

<body>

    <form class="nav" method="POST" action="">

        <h1>
            <lord-icon src="https://cdn.lordicon.com/bgebyztw.json" trigger="hover" state="hover-looking-around" colors="primary:#ffffff,secondary:#4f1091" style="width:40px;height:40px">
            </lord-icon>
            <?php echo $_SESSION['usuario'];
            ?>
        </h1>


        <div class="btn-telas">
            <input class="btn" id="btnCompra" type="button" name="button" value="Comprar">
            <input class="btn" id="btnVendas" type="button" name="button" value="Minhas Vendas">
            <input class="btn" id="btnAddProd" type="button" name="button" value="Add Produto">
        </div>


        <a href="../controller/logout.php" style="text-decoration:none">Logout</a>

    </form>

    <main class="main">
        <div id="comprarContent" style="display: block;">
            <?php include(__DIR__ . '../../view/compra.php'); ?>
        </div>
        <div id="minhasVendasContent" style="display: none;">
            <?php include(__DIR__ . '../../view/minhasVendas.php'); ?>
        </div>
        <div id="addProdutoContent" style="display: none;">
            <?php include(__DIR__ . '../../view/addProduto.php'); ?>
        </div>
    </main>

    <script type="module" src="./main.js"></script>
</body>

</html>