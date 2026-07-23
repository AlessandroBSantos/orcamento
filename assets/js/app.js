/*
=====================================================
LLA ERP
app.js

Arquivo principal de JavaScript responsável pelas
funcionalidades globais da interface do sistema.

Funções:
- Inicialização do menu lateral
- Controle de abertura e fechamento do menu
- Destaque automático da página ativa no menu
=====================================================
*/

document.addEventListener("DOMContentLoaded", () => {

    // Aguarda todo o conteúdo HTML ser carregado
    // e inicia as funções principais da interface.
    iniciarMenu();
    destacarMenu();

});

/*
=====================================================
MENU LATERAL
=====================================================

Responsável por controlar o comportamento do menu
lateral (sidebar).

Ao clicar no botão do menu:
- Abre ou fecha a sidebar.
- Ajusta a área de conteúdo principal.

Classes utilizadas:
.active     -> Exibe/Oculta a sidebar.
.menu-open  -> Ajusta a área principal quando
               o menu está aberto.
=====================================================
*/

function iniciarMenu() {

    // Botão responsável por abrir/fechar o menu.
    const btnMenu = document.getElementById("btnMenu");

    // Elemento da barra lateral.
    const sidebar = document.getElementById("sidebar");

    // Área principal do conteúdo.
    const content = document.querySelector(".content");

    // Verifica se todos os elementos necessários
    // existem antes de continuar.
    if (!btnMenu || !sidebar || !content) {
        console.error("Erro: elementos do menu não encontrados.");
        return;
    }

    // Evento executado quando o usuário clica
    // no botão do menu.
    btnMenu.addEventListener("click", () => {

        // Alterna a classe "active" na sidebar.
        sidebar.classList.toggle("active");

        // Alterna a classe "menu-open" no conteúdo.
        content.classList.toggle("menu-open");

    });

}

/*
=====================================================
DESTACA MENU ATUAL
=====================================================

Percorre todos os links existentes no menu lateral.

Compara o endereço (href) de cada link com a
URL atual da página.

Caso sejam iguais, adiciona a classe "active"
para destacar visualmente o item do menu.
=====================================================
*/

function destacarMenu() {

    // Seleciona todos os links existentes
    // dentro do menu lateral.
    const links = document.querySelectorAll(".sidebar-menu a");

    // Obtém o caminho da página atual.
    const paginaAtual = window.location.pathname;

    // Percorre todos os links encontrados.
    links.forEach(link => {

        // Verifica se o link corresponde
        // à página atualmente aberta.
        if (link.getAttribute("href") === paginaAtual) {

            // Adiciona a classe "active"
            // para destacar o menu.
            link.classList.add("active");
        }

    });

}