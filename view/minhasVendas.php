<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>

<body>
    <h1 class="titulo">Minhas Vendas</h1>
    <section class="produtos">
        <?php include(__DIR__ . '../../controller/listaVenda.php'); ?>
    </section>
</body>
<script>
    document.querySelector('input[value="Atualizar"]').addEventListener('click', function() {
        document.getElementById('action').value = 'Atualizar';
    });

    document.querySelector('input[value="Deletar"]').addEventListener('click', function() {
        document.getElementById('action').value = 'Deletar';
        console.log("Deletar");
    });
</script>