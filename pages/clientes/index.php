<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Listagem de Clientes
|--------------------------------------------------------------------------
|
| Esta página é responsável por exibir todos os
| clientes cadastrados no sistema.
|
| Funcionalidades:
|
| • Carrega o layout padrão.
| • Obtém a lista de clientes através do ClienteController.
| • Exibe mensagens de sucesso.
| • Lista todos os clientes cadastrados.
| • Disponibiliza ações de edição e exclusão.
|--------------------------------------------------------------------------
*/

//
// Define o título da página.
//
$titulo = "Clientes";

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
// Cria uma instância do
// ClienteController.
//
$controller = new ClienteController();

//
// Recupera todos os clientes
// cadastrados.
//
$clientes = $controller->index();

?>

<!--
|--------------------------------------------------------------------------
| Cabeçalho da Página
|--------------------------------------------------------------------------
|
| Exibe o título da tela e o botão
| para cadastro de um novo cliente.
|--------------------------------------------------------------------------
-->

<div class="dashboard-header">

    <div>

        <h1>Clientes</h1>

        <p>Cadastro de Clientes</p>

    </div>

    <a href="novo.php" class="btn">

        + Novo Cliente

    </a>

</div>

<!--
|--------------------------------------------------------------------------
| Mensagens de Sucesso
|--------------------------------------------------------------------------
|
| Exibe uma mensagem conforme
| a operação realizada anteriormente.
|--------------------------------------------------------------------------
-->

<?php if(isset($_GET['sucesso'])): ?>

<div class="alert alert-success">

    <?php

switch($_GET['sucesso']){

    case "cadastrado":

        echo "Cliente cadastrado com sucesso.";

        break;

    case "editado":

        echo "Cliente atualizado com sucesso.";

        break;

    case "excluido":

        echo "Cliente excluído com sucesso.";

        break;

}

?>

</div>

<?php endif; ?>

<!--
|--------------------------------------------------------------------------
| Tabela de Clientes
|--------------------------------------------------------------------------
|
| Exibe todos os clientes retornados
| pelo ClienteController.
|--------------------------------------------------------------------------
-->

<div class="panel">

    <table>

        <thead>

            <tr>

                <!-- Identificador -->
                <th>ID</th>

                <!-- Nome -->
                <th>Nome</th>

                <!-- Cidade -->
                <th>Cidade</th>

                <!-- Documento -->
                <th>CPF/CNPJ</th>

                <!-- Situação -->
                <th>Status</th>

                <!-- Botões -->
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

            <!--
            |--------------------------------------------------------------------------
            | Verifica se existem clientes cadastrados.
            |--------------------------------------------------------------------------
            -->

            <?php if(!empty($clientes)): ?>

            <!-- Percorre toda a lista de clientes -->

            <?php foreach($clientes as $cliente): ?>

            <tr>

                <!-- ID -->
                <td><?= $cliente['id'] ?></td>

                <!-- Nome -->
                <td><?= htmlspecialchars($cliente['nome']) ?></td>

                <!-- Cidade -->
                <td><?= htmlspecialchars($cliente['cidade']) ?></td>

                <!-- CPF ou CNPJ -->
                <td><?= htmlspecialchars($cliente['cpf_cnpj']) ?></td>

                <!-- Status -->
                <td><?= htmlspecialchars($cliente['status']) ?></td>

                <!--
                |--------------------------------------------------------------------------
                | Ações disponíveis
                |--------------------------------------------------------------------------
                |
                | • Editar cadastro
                | • Excluir cliente
                |--------------------------------------------------------------------------
                -->

                <td>

                    <!-- Botão Editar -->

                    <a href="editar.php?id=<?= $cliente['id'] ?>" class="btn btn-primary">

                        Editar

                    </a>

                    <!-- Botão Excluir -->

                    <a href="excluir.php?id=<?= $cliente['id'] ?>" class="btn btn-danger"
                        onclick="return confirm('Deseja realmente excluir este cliente?');">

                        Excluir

                    </a>

                </td>

            </tr>

            <?php endforeach; ?>

            <?php else: ?>

            <!--
            |--------------------------------------------------------------------------
            | Nenhum cliente encontrado.
            |--------------------------------------------------------------------------
            -->

            <tr>

                <td colspan="6">

                    Nenhum cliente cadastrado.

                </td>

            </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>

<?php

//
// Carrega o encerramento do layout,
// incluindo footer e scripts globais.
//
require_once '../../includes/layout_fim.php';

?>