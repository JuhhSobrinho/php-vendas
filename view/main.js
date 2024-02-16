const compra = document.getElementById('btnCompra');
const vendas = document.getElementById('btnVendas');
const addProd = document.getElementById('btnAddProd');



compra.addEventListener('click', () => {
    document.getElementById('comprarContent').style.display = 'block';
    document.getElementById('minhasVendasContent').style.display = 'none';
    document.getElementById('addProdutoContent').style.display = 'none';
});
vendas.addEventListener('click', () => {
    document.getElementById('comprarContent').style.display = 'none';
    document.getElementById('minhasVendasContent').style.display = 'block';
    document.getElementById('addProdutoContent').style.display = 'none';
});
addProd.addEventListener('click', () => {
    document.getElementById('comprarContent').style.display = 'none';
    document.getElementById('minhasVendasContent').style.display = 'none';
    document.getElementById('addProdutoContent').style.display = 'block';
});