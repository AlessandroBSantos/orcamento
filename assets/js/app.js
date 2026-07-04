/*
======================================================
LLA ERP
app.js
======================================================
*/


document.addEventListener("DOMContentLoaded", () => {

    iniciarMenu();

    destacarMenu();

});


/*
======================================================
MENU LATERAL
======================================================
*/

function iniciarMenu() {

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    if (!btnMenu || !sidebar || !content) {
        console.log("Menu não encontrado");
        return;
    }

    btnMenu.addEventListener("click", function () {

        sidebar.classList.toggle("active");

        content.classList.toggle("menu-open");

    });

}


/*
======================================================
DESTACA MENU ATUAL
======================================================
*/

function destacarMenu(){

    const links = document.querySelectorAll(".sidebar a");

    const pagina = window.location.pathname;

    links.forEach(link=>{

        if(pagina.includes(link.getAttribute("href"))){

            link.classList.add("active");

        }

    });

}