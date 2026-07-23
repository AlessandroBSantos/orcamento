<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Editar Cliente
|--------------------------------------------------------------------------
|
| Esta página é responsável por carregar os dados
| de um cliente já cadastrado para edição.
|
| Fluxo de execução:
|
| 1. Define o título da página.
| 2. Carrega o layout padrão do sistema.
| 3. Carrega o ClienteController.
| 4. Obtém o ID enviado pela URL.
| 5. Busca os dados do cliente.
| 6. Exibe o formulário preenchido.
| 7. Envia as alterações para atualizar.php.
|--------------------------------------------------------------------------
*/

//
// Título exibido no cabeçalho
// da página.
//
$titulo = "Editar Cliente";

//
// Carrega o layout inicial
// do sistema.
//
require_once '../../includes/layout_inicio.php';

//
// Carrega o Controller responsável
// pelas operações de clientes.
//
require_once '../../controllers/ClienteController.php';

//
// Verifica se o ID do cliente
// foi informado pela URL.
//
if (!isset($_GET['id'])) {

    //
    // Interrompe a execução caso
    // o ID não tenha sido enviado.
    //
    die("ID do cliente não informado.");

}

//
// Converte o ID recebido
// para inteiro por segurança.
//
$id = (int) $_GET['id'];

//
// Cria uma instância do
// ClienteController.
//
$controller = new ClienteController();

//
// Busca os dados do cliente
// utilizando o ID informado.
//
$cliente = $controller->buscarPorId($id);

//
// Verifica se o cliente
// foi localizado.
//
if (!$cliente) {

    //
    // Interrompe a execução caso
    // o cliente não exista.
    //
    die("Cliente não encontrado.");

}

?>

<!--
|--------------------------------------------------------------------------
| Cabeçalho da Página
|--------------------------------------------------------------------------
|
| Exibe o título da tela e o botão
| para retorno à listagem de clientes.
|--------------------------------------------------------------------------
-->

<div class="dashboard-header">

    <div>

        <h1>Editar Cliente</h1>

        <p>Teste de carregamento dos dados</p>

    </div>

    <a href="index.php" class="btn">

        ← Voltar

    </a>

</div>

<!--
|--------------------------------------------------------------------------
| Formulário de Edição
|--------------------------------------------------------------------------
|
| Envia os dados atualizados
| para o arquivo atualizar.php.
|--------------------------------------------------------------------------
-->

<form action="atualizar.php" method="POST">

    <!--
    |--------------------------------------------------------------------------
    | ID do Cliente
    |--------------------------------------------------------------------------
    |
    | Campo oculto utilizado para identificar
    | qual registro será atualizado.
    |--------------------------------------------------------------------------
    -->

    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

    <div class="panel">

        <h2>Dados Gerais</h2>

        <div class="form-grid">

            <!-- Tipo de Cliente -->
            <div class="form-group">

                <label>Tipo</label>

                <select name="tipo">

                    <option value="PF" <?= $cliente['tipo']=="PF"?"selected":"" ?>>

                        Pessoa Física

                    </option>

                    <option value="PJ" <?= $cliente['tipo']=="PJ"?"selected":"" ?>>

                        Pessoa Jurídica

                    </option>

                </select>

            </div>

            <!-- Situação do Cliente -->
            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option value="Ativo" <?= $cliente['status']=="Ativo"?"selected":"" ?>>

                        Ativo

                    </option>

                    <option value="Inativo" <?= $cliente['status']=="Inativo"?"selected":"" ?>>

                        Inativo

                    </option>

                </select>

            </div>

            <!-- Nome Completo -->
            <div class="form-group">

                <label>Nome</label>

                <input
                    type="text"
                    name="nome"
                    value="<?= htmlspecialchars($cliente['nome']) ?>">

            </div>

            <!-- Nome Fantasia -->
            <div class="form-group">

                <label>Nome Fantasia</label>

                <input
                    type="text"
                    name="nome_fantasia"
                    value="<?= htmlspecialchars($cliente['nome_fantasia']) ?>">

            </div>

            <!-- CPF ou CNPJ -->
            <div class="form-group">

                <label>CPF/CNPJ</label>

                <input
                    type="text"
                    name="cpf_cnpj"
                    value="<?= htmlspecialchars($cliente['cpf_cnpj']) ?>">

            </div>

            <!-- RG ou Inscrição Estadual -->
            <div class="form-group">

                <label>RG / IE</label>

                <input
                    type="text"
                    name="rg_ie"
                    value="<?= htmlspecialchars($cliente['rg_ie']) ?>">

            </div>

        </div>

    </div>

    <br>

    <!--
    |--------------------------------------------------------------------------
    | Botão de Salvar
    |--------------------------------------------------------------------------
    |
    | Envia todas as alterações
    | realizadas no formulário.
    |--------------------------------------------------------------------------
    -->

    <button type="submit" class="btn">

        💾 Salvar Alterações

    </button>

</form>

<?php

//
// Carrega o encerramento do layout,
// incluindo footer e scripts globais.
//
require_once '../../includes/layout_fim.php';

?>