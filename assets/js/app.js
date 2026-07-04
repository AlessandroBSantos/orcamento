document.addEventListener("DOMContentLoaded", () => {

    const btnMenu = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");
    const content = document.querySelector(".content");

    if(btnMenu){

        btnMenu.addEventListener("click",()=>{

            sidebar.classList.toggle("active");

            content.classList.toggle("menu-open");

        });

    }

    const links=document.querySelectorAll(".sidebar-menu a");

    const pagina=window.location.pathname;

    links.forEach(link=>{

        if(link.getAttribute("href")==pagina){

            link.classList.add("active");

        }

    });

});