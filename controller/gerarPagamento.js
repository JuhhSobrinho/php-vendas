import 'https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js';
const debito = document.getElementById('btn-debito');
const credito = document.getElementById('btn-credito');
const pix = document.getElementById('btn-pix');

const inputParcelas = document.getElementById('input-parcela');
const textParcelas = document.getElementById('text-parcela');
const textPriceInicial = document.getElementById('price-inicial');

const finalizarCompra = document.getElementById('finalizar-compra');


const vendedor = document.getElementById('nome-vendedor');
const comprador = document.getElementById('nome-cliente');

let formaDePagamento = '';
let formaDeParcela = false;

debito.addEventListener('click', () => {
    debito.style.backgroundColor = "crimson";
    credito.style.backgroundColor = "transparent";
    pix.style.backgroundColor = "transparent";

    formaDePagamento = 'debito';
});

credito.addEventListener('click', () => {
    credito.style.backgroundColor = "crimson";
    debito.style.backgroundColor = "transparent";
    pix.style.backgroundColor = "transparent";

    formaDePagamento = 'credito';
});

pix.addEventListener('click', () => {
    pix.style.backgroundColor = "crimson";
    credito.style.backgroundColor = "transparent";
    debito.style.backgroundColor = "transparent";

    formaDePagamento = 'pix';
});



const priceInicial = textPriceInicial.value;
let result;
let pdpParcela;

inputParcelas.addEventListener('input', () => {
    const parcelas = parseInt(inputParcelas.value);
    pdpParcela = parcelas;
    if (!isNaN(parcelas) && parcelas >= 1 && parcelas <= 12) {
        let math = priceInicial / parcelas;
        textParcelas.value = math.toFixed(2);
        formaDeParcela = true;
        result = math.toFixed(2);
    } else {
        formaDeParcela = false;
        textParcelas.value = 'Parcela Indefinida';
    }
});








// Configurações para o PDF
const opcoes = {
    margin: 10,
    filename: `compra no valor de ${priceInicial}`,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
};


finalizarCompra.addEventListener('click', () => {
    if (formaDeParcela === true && formaDePagamento !== '') {
        const compradorValue = comprador.value;

        const dadosBoleto = {
            nomeCliente: `${compradorValue}`,
            parcela: `${pdpParcela}`,
            precoParcela: `${result}`,
            precoTotal: `${priceInicial}`,
            nomeVendedor: `${vendedor.value}`,
            formaDePagamento: `${formaDePagamento}`
          };

          const textoDinamico = `
          <div>
              <h2>Comprovante</h2>
              <div style="float: left; width: 50%;">
                  <p><strong>Nome do Cliente:</strong> ${dadosBoleto.nomeCliente}</p>
                  <p><strong>Forma de Pagamento:</strong> ${dadosBoleto.formaDePagamento}</p>
                  <p><strong>Parcela:</strong> ${dadosBoleto.parcela}</p>
                  <p><strong>Preço da Parcelas:</strong> R$ ${dadosBoleto.precoParcela}</p>
                  <p><strong>Preço Total:</strong> R$ ${dadosBoleto.precoTotal}</p>
                  <p><strong>Nome do Vendedor:</strong> ${dadosBoleto.nomeVendedor}</p>
              </div>
              <div style="float: right; width: 50%;">
                  <h3>Próximas Parcelas</h3>
                  <ul>
                      ${gerarParcelasFuturas(dadosBoleto)}
                  </ul>
              </div>
          </div>
      `;


        const elementoTexto = document.createElement('div');


        elementoTexto.innerHTML  = textoDinamico;
        document.getElementById('seuElemento').appendChild(elementoTexto);

        html2pdf(document.getElementById('seuElemento'), opcoes).then(() => {
            window.location = "../view/menu.php";
        });
        
        
    } else {
        alert('dados incorretos');
    }
})


function gerarParcelasFuturas(dadosBoleto) {
    const listaParcelas = [];
    const precoParcelaFormatado = `R$ ${dadosBoleto.precoParcela}`;
    
    const mesAtual = new Date().getMonth();
    const meses = [
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    ];

    for (let i = 1; i <= dadosBoleto.parcela; i++) {
        const mesParcela = meses[(mesAtual + i - 1) % meses.length];
        listaParcelas.push(`<li>Mês ${i} (${mesParcela}) - Parcela a Pagar: ${precoParcelaFormatado}</li>`);
    }

    return listaParcelas.join('');
}