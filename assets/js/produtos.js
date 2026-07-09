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

    const custo = document.getElementById("custo");
    const lucro = document.getElementById("percentual_lucro");
    const venda = document.getElementById("preco_venda");

    if (!custo || !lucro || !venda) {
        return;
    }

    custo.addEventListener("input", calcularPrecoVenda);
    lucro.addEventListener("input", calcularPrecoVenda);

}

/*====================================================
CÁLCULO
====================================================*/

function calcularPrecoVenda() {

    const custo = parseFloat(document.getElementById("custo").value) || 0;
    const lucro = parseFloat(document.getElementById("percentual_lucro").value) || 0;

    const preco = custo + (custo * lucro / 100);

    document.getElementById("preco_venda").value = preco.toFixed(2);

}