const btnMenu=document.getElementById("btnMenu");

const sidebar=document.getElementById("sidebar");

const content=document.getElementById("content");

btnMenu.addEventListener("click",()=>{

    sidebar.classList.toggle("active");

    if(window.innerWidth>992){

        content.classList.toggle("menu-open");

    }

});