<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Verificação de Autenticação
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por controlar o acesso
| às páginas protegidas do sistema.
|
| Funcionamento:
| - Inicia a sessão caso ela ainda não exista.
| - Verifica se existe um usuário autenticado.
| - Caso não exista, redireciona para a tela de login.
|
| Este arquivo deve ser incluído em todas as páginas
| que exigem autenticação do usuário.
|--------------------------------------------------------------------------
*/

//
// Verifica se existe uma sessão ativa.
// Caso não exista, inicia uma nova sessão.
//
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//
// Verifica se o usuário está autenticado.
//
// A variável de sessão "usuario_id" é criada
// durante o processo de login.
//
if (!isset($_SESSION['usuario_id'])) {

    //
    // Redireciona o usuário para
    // a página de login.
    //
    header("Location: /orcamento/login.php");

    //
    // Encerra imediatamente a execução
    // do script após o redirecionamento.
    //
    exit;

}