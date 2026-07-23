/*
=====================================================
LLA ERP
produtos.js

Arquivo responsável pelo cálculo automático
do preço de venda dos produtos.

Funcionalidades:
- Inicialização do cálculo automático.
- Atualização do preço de venda em tempo real.
- Cálculo baseado no custo e percentual de lucro.
=====================================================
*/

document.addEventListener("DOMContentLoaded", function () {

    // Aguarda o carregamento completo da página
    // para iniciar o cálculo do preço de venda.
    iniciarCalculoPreco();

});

/*====================================================
CALCULA PREÇO DE VENDA
======================================================

Esta função localiza os campos utilizados
no cálculo do preço de venda e registra
os eventos responsáveis por atualizar
automaticamente o valor da venda.

Campos utilizados:
- custo
- percentual_lucro
- preco_venda

====================================================*/

function iniciarCalculoPreco() {

    // Campo onde é informado
    // o custo do produto.
    const campoCusto = document.getElementById("custo");

    // Campo onde é informado
    // o percentual de lucro.
    const campoLucro = document.getElementById("percentual_lucro");

    // Campo que exibirá
    // o preço de venda calculado.
    const campoVenda = document.getElementById("preco_venda");

    // Se algum dos campos não existir,
    // interrompe a execução da função.
    if (!campoCusto || !campoLucro || !campoVenda) {
        return;
    }

    // Sempre que o custo for alterado,
    // recalcula o preço de venda.
    campoCusto.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Sempre que o percentual de lucro
    // for alterado, recalcula o preço.
    campoLucro.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Executa o cálculo uma vez
    // quando a página é carregada.
    calcularPrecoVenda(campoCusto, campoLucro, campoVenda);

}

/*====================================================
CÁLCULO DO PREÇO DE VENDA
======================================================

Realiza o cálculo do preço de venda
utilizando a seguinte fórmula:

Preço de Venda =
Custo + (Custo × Percentual de Lucro / 100)

Caso algum campo esteja vazio,
o valor considerado será zero.

O resultado é apresentado
com duas casas decimais.

====================================================*/

function calcularPrecoVenda(campoCusto, campoLucro, campoVenda) {

    // Obtém o custo do produto.
    // Caso esteja vazio,
    // considera o valor zero.
    const custo = parseFloat(campoCusto.value) || 0;

    // Obtém o percentual de lucro.
    // Caso esteja vazio,
    // considera o valor zero.
    const lucro = parseFloat(campoLucro.value) || 0;

    // Calcula o preço final de venda.
    const precoVenda = custo + (custo * lucro / 100);

    // Exibe o resultado no campo
    // com duas casas decimais.
    campoVenda.value = precoVenda.toFixed(2);

}