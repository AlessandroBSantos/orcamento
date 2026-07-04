alert("APP.JS CARREGOU");

document.addEventListener("DOMContentLoaded", function () {

    alert("DOM PRONTO");

    const btn = document.getElementById("btnMenu");

    btn.onclick = function () {

        alert("CLICOU");

    };

});