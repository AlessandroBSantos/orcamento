/*
=====================================================
BUSCA AUTOMÁTICA DE CEP
=====================================================

Este script realiza a consulta automática do endereço
utilizando a API pública do ViaCEP.

Fluxo:
1. Aguarda o carregamento da página.
2. Verifica se existe o campo CEP.
3. Quando o usuário sai do campo (blur),
   chama a função buscarCEP().
4. Consulta a API do ViaCEP.
5. Preenche automaticamente os campos
   de endereço.

=====================================================
*/

document.addEventListener("DOMContentLoaded", () => {

    // Localiza o campo de CEP na página.
    const cep = document.getElementById("cep");

    // Caso o campo não exista,
    // encerra a execução do script.
    if (!cep) return;

    // Quando o usuário terminar de digitar
    // e sair do campo, executa a busca.
    cep.addEventListener("blur", buscarCEP);

});

/*
=====================================================
FUNÇÃO BUSCAR CEP
=====================================================

Responsável por:

- Ler o CEP informado.
- Remover caracteres não numéricos.
- Validar se possui 8 dígitos.
- Consultar a API do ViaCEP.
- Preencher automaticamente os campos
  do formulário.

=====================================================
*/

function buscarCEP() {

    // Obtém o valor digitado no campo CEP.
    let cep = document.getElementById("cep").value;

    // Remove qualquer caractere que não seja número.
    cep = cep.replace(/\D/g, "");

    // Valida se o CEP possui exatamente
    // 8 dígitos.
    if (cep.length !== 8) {

        return;

    }

    // Realiza a consulta na API do ViaCEP.
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(dados => {

            // Verifica se o CEP informado
            // foi encontrado.
            if (dados.erro) {

                alert("CEP não encontrado.");

                return;

            }

            // Preenche automaticamente
            // os campos do formulário.
            document.getElementById("endereco").value = dados.logradouro;
            document.getElementById("bairro").value = dados.bairro;
            document.getElementById("cidade").value = dados.localidade;
            document.getElementById("estado").value = dados.uf;

        });