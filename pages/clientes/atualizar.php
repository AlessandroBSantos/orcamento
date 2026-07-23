<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Atualização de Cliente
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por processar
| a atualização dos dados de um cliente.
|
| Fluxo de execução:
|
| 1. Verifica se a requisição foi enviada via POST.
| 2. Instancia o ClienteController.
| 3. Envia os dados para atualização.
| 4. Redireciona para a listagem em caso de sucesso.
| 5. Retorna para a tela de edição em caso de erro.
|--------------------------------------------------------------------------
*/

//
// Carrega o Controller responsável
// pelas operações relacionadas aos clientes.
//
require_once '../../controllers/ClienteController.php';

//
// Verifica se a requisição foi enviada
// utilizando o método HTTP POST.
//
if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    //
    // Caso o acesso seja direto,
    // retorna para a página inicial.
    //
    header("Location: index.php");
    exit;

}

//
// Cria uma instância do
// ClienteController.
//
$controller = new ClienteController();

//
// Envia os dados recebidos do formulário
// para atualização do cliente.
//
$resultado = $controller->atualizar($_POST);

//
// Verifica se a atualização foi
// realizada com sucesso.
//
if ($resultado) {

    //
    // Redireciona para a listagem
    // informando sucesso na operação.
    //
    header("Location: index.php?sucesso=editado");
    exit;

}

//
// Caso ocorra algum erro durante
// a atualização, retorna para
// a tela de edição mantendo
// o ID do cliente.
//
header("Location: editar.php?id=" . $_POST['id'] . "&erro=1");
exit;