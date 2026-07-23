/*
=====================================================
LLA ERP
tabs.js

Arquivo responsável pelo controle das abas
(Tab Navigation) do sistema.

Funções:
- Alternar entre as abas.
- Exibir somente o conteúdo da aba selecionada.
- Destacar visualmente a aba ativa.

=====================================================
*/

document.addEventListener("DOMContentLoaded", () => {

    // Seleciona todos os botões das abas.
    const botoes = document.querySelectorAll(".tab-button");

    // Seleciona todos os conteúdos das abas.
    const conteudos = document.querySelectorAll(".tab-content");

    // Percorre todos os botões encontrados.
    botoes.forEach(botao => {

        // Adiciona o evento de clique
        // para cada botão.
        botao.addEventListener("click", () => {

            // Remove a classe "active"
            // de todos os botões.
            botoes.forEach(b => b.classList.remove("active"));

            // Remove a classe "active"
            // de todos os conteúdos.
            conteudos.forEach(c => c.classList.remove("active"));

            // Adiciona a classe "active"
            // ao botão clicado.
            botao.classList.add("active");

            // Localiza o conteúdo correspondente
            // utilizando o atributo data-tab
            // e exibe a aba selecionada.
            document
                .getElementById(botao.dataset.tab)
                .classList.add("active");

        });

    });

});