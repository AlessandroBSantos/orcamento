document.addEventListener("DOMContentLoaded", function () {

    console.log("LLA ERP - app.js carregado");

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    console.log(btnMenu);
    console.log(sidebar);
    console.log(content);

    if (!btnMenu || !sidebar || !content) {
        console.error("Algum elemento não foi encontrado.");
        return;
    }

    btnMenu.addEventListener("click", function () {

        console.log("Clique no menu");

        sidebar.classList.toggle("active");
        content.classList.toggle("menu-open");

    });

});