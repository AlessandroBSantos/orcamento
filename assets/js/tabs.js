document.addEventListener("DOMContentLoaded", () => {

    const botoes = document.querySelectorAll(".tab-button");

    const conteudos = document.querySelectorAll(".tab-content");

    botoes.forEach(botao => {

        botao.addEventListener("click", () => {

            botoes.forEach(b => b.classList.remove("active"));

            conteudos.forEach(c => c.classList.remove("active"));

            botao.classList.add("active");

            document
                .getElementById(botao.dataset.tab)
                .classList.add("active");

        });

    });

});