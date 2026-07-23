/*
=====================================================
LLA ERP
app.js
=====================================================
*/

document.addEventListener("DOMContentLoaded", () => {

    iniciarMenu();
    destacarMenu();

});

/*
=====================================================
MENU LATERAL
=====================================================
*/

function iniciarMenu() {

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    if (!btnMenu || !sidebar || !content) {
        console.error("Erro: elementos do menu não encontrados.");
        return;
    }

    btnMenu.addEventListener("click", () => {

        sidebar.classList.toggle("active");
        content.classList.toggle("menu-open");

    });

}

/*
=====================================================
DESTACA MENU ATUAL
=====================================================
*/

function destacarMenu() {

    const links = document.querySelectorAll(".sidebar-menu a");
    const paginaAtual = window.location.pathname;

    links.forEach(link => {

        if (link.getAttribute("href") === paginaAtual) {
            link.classList.add("active");
        }

    });

}