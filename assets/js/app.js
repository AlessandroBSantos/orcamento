document.addEventListener("DOMContentLoaded", function () {

    console.log("LLA ERP iniciado");

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    if (!btnMenu || !sidebar || !content) {
        console.error("Elementos do menu não encontrados.");
        return;
    }

    btnMenu.addEventListener("click", function () {

        sidebar.classList.toggle("active");
        content.classList.toggle("menu-open");

    });

});