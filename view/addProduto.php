<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
</head>

<body>
    <form class="card" method="POST" action="../controller/newProduto.php">
        <lord-icon src="https://cdn.lordicon.com/ofwxettw.json" trigger="loop" delay="2000" colors="primary:#ffffff,secondary:#4f1091" style="width:120px;height:120px">
        </lord-icon>
        <p></p>
        <input type="text" name="Produto" placeholder="Produto">
        <input type="text" pattern="\d+(\.\d{1,2})?" name="Price" placeholder="Preço" />
        <p></p>
        <div class="botoes">
            <input type="submit" name="Submit" value="Adicionar Produto">
        </div>
    </form>
</body>