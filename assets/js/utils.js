/*
=====================================================
LLA ERP
produtos.js
=====================================================
*/

document.addEventListener("DOMContentLoaded", function () {

    iniciarCalculoPreco();

});

/*====================================================
CALCULA PREÇO DE VENDA
====================================================*/

function iniciarCalculoPreco() {

    const campoCusto = document.getElementById("custo");
    const campoLucro = document.getElementById("percentual_lucro");
    const campoVenda = document.getElementById("preco_venda");

    // Se os campos não existirem, encerra a função
    if (!campoCusto || !campoLucro || !campoVenda) {
        return;
    }

    // Calcula ao alterar o custo
    campoCusto.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Calcula ao alterar o percentual de lucro
    campoLucro.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Calcula uma vez ao carregar a página
    calcularPrecoVenda(campoCusto, campoLucro, campoVenda);

}

/*====================================================
CÁLCULO DO PREÇO DE VENDA
====================================================*/

function calcularPrecoVenda(campoCusto, campoLucro, campoVenda) {

    const custo = parseFloat(campoCusto.value) || 0;
    const lucro = parseFloat(campoLucro.value) || 0;

    const precoVenda = custo + (custo * lucro / 100);

    campoVenda.value = precoVenda.toFixed(2);

}