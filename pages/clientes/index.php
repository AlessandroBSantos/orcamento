<?php

$titulo = "Clientes";

require_once '../../includes/layout_inicio.php';


?>

<div class="dashboard-header">

    <h1>Clientes</h1>

    <a href="novo.php" class="btn">

        + Novo Cliente

    </a>

</div>

<div class="panel">

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Nome</th>

                <th>Email</th>

                <th>Telefone</th>

                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td colspan="5">

                    Nenhum cliente cadastrado.

                </td>

            </tr>

        </tbody>

    </table>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>