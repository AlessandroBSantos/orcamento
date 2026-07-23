<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Exclusão de Cliente
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por processar
| a exclusão de um cliente cadastrado.
|
| Fluxo de execução:
|
| 1. Verifica se o ID foi informado.
| 2. Converte o ID para inteiro.
| 3. Instancia o ClienteController.
| 4. Executa a exclusão do cliente.
| 5. Redireciona para a listagem em caso
|    de sucesso.
| 6. Retorna informando erro caso
|    a exclusão não seja realizada.
|--------------------------------------------------------------------------
*/

//
// Carrega o Controller responsável
// pelas operações relacionadas aos clientes.
//
require_once '../../controllers/ClienteController.php';

//
// Verifica se o parâmetro "id"
// foi informado na URL.
//
if (!isset($_GET['id']) || empty($_GET['id'])) {

    //
    // Caso o ID não seja informado,
    // retorna para a listagem.
    //
    header("Location: index.php");
    exit;

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
// Solicita ao Controller
// a exclusão do cliente.
//
$resultado = $controller->excluir($id);

//
// Verifica se a exclusão foi
// realizada com sucesso.
//
if ($resultado) {

    //
    // Retorna para a listagem
    // exibindo mensagem de sucesso.
    //
    header("Location: index.php?sucesso=excluido");
    exit;

}

//
// Caso ocorra algum erro,
// retorna para a listagem
// informando a falha.
//
header("Location: index.php?erro=1");
exit;