alert("APP.JS CARREGOU");

document.addEventListener("DOMContentLoaded", function () {

    alert("DOM PRONTO");

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    console.log(btnMenu);
    console.log(sidebar);
    console.log(content);

    if (!btnMenu || !sidebar || !content) {
        alert("Elemento não encontrado");
        return;
    }

    btnMenu.addEventListener("click", function () {

        alert("CLIQUE");

        sidebar.classList.toggle("active");
        content.classList.toggle("menu-open");

    });

});