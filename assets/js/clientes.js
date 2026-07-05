document.addEventListener("DOMContentLoaded", () => {

    const cep = document.getElementById("cep");

    if (!cep) return;

    cep.addEventListener("blur", buscarCEP);

});

function buscarCEP() {

    let cep = document.getElementById("cep").value;

    cep = cep.replace(/\D/g, "");

    if (cep.length !== 8) {

        return;

    }

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(dados => {

            if (dados.erro) {

                alert("CEP não encontrado.");

                return;

            }

            document.getElementById("endereco").value = dados.logradouro;
            document.getElementById("bairro").value = dados.bairro;
            document.getElementById("cidade").value = dados.localidade;
            document.getElementById("estado").value = dados.uf;

        });

}