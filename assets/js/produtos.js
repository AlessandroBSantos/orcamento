/*
=====================================================
LLA ERP
produtos.js

Arquivo responsável pelas funcionalidades da tela
de cadastro de produtos.

Funções:
- Inicialização do cálculo automático.
- Cálculo do preço de venda.
- Atualização automática conforme o usuário digita.
=====================================================
*/

document.addEventListener("DOMContentLoaded", function () {

    // Aguarda o carregamento completo da página
    // e inicia o cálculo automático do preço.
    iniciarCalculoPreco();

});

/*====================================================
CALCULA PREÇO DE VENDA
======================================================

Esta função localiza os campos utilizados
no cálculo do preço de venda.

Campos utilizados:
- Custo do produto
- Percentual de lucro
- Preço de venda

Também registra os eventos para que o valor
seja atualizado automaticamente enquanto o
usuário digita.

====================================================*/

function iniciarCalculoPreco() {

    // Campo que recebe o custo do produto.
    const campoCusto = document.getElementById("custo");

    // Campo do percentual de lucro.
    const campoLucro = document.getElementById("percentual_lucro");

    // Campo onde será exibido
    // o preço final de venda.
    const campoVenda = document.getElementById("preco_venda");

    // Se algum dos campos não existir,
    // encerra a execução da função.
    if (!campoCusto || !campoLucro || !campoVenda) {
        return;
    }

    // Recalcula o preço sempre que
    // o custo do produto for alterado.
    campoCusto.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Recalcula o preço sempre que
    // o percentual de lucro for alterado.
    campoLucro.addEventListener("input", function () {
        calcularPrecoVenda(campoCusto, campoLucro, campoVenda);
    });

    // Executa um cálculo inicial
    // quando a página é carregada.
    calcularPrecoVenda(campoCusto, campoLucro, campoVenda);

}

/*====================================================
CÁLCULO DO PREÇO DE VENDA
======================================================

Esta função realiza o cálculo do preço
de venda do produto utilizando a fórmula:

Preço de Venda =
Custo + (Custo × Percentual de Lucro ÷ 100)

Caso os campos estejam vazios,
o valor considerado será zero.

O resultado é exibido com
duas casas decimais.

====================================================*/

function calcularPrecoVenda(campoCusto, campoLucro, campoVenda) {

    // Obtém o valor do custo.
    // Caso esteja vazio, utiliza zero.
    const custo = parseFloat(campoCusto.value) || 0;

    // Obtém o percentual de lucro.
    // Caso esteja vazio, utiliza zero.
    const lucro = parseFloat(campoLucro.value) || 0;

    // Calcula o preço final de venda.
    const precoVenda = custo + (custo * lucro / 100);

    // Exibe o resultado formatado
    // com duas casas decimais.
    campoVenda.value = precoVenda.toFixed(2);