<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| BaseController
|--------------------------------------------------------------------------
|
| Classe base utilizada por todos os Controllers
| do sistema seguindo o padrão MVC.
|
| Responsabilidades:
| - Carregar páginas (Views).
| - Realizar redirecionamentos.
|
| Os demais Controllers deverão herdar esta classe
| para reutilizar essas funcionalidades.
|--------------------------------------------------------------------------
*/

abstract class BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Carrega uma View
    |--------------------------------------------------------------------------
    |
    | Recebe o caminho da página que será exibida
    | e um array contendo os dados que serão
    | disponibilizados para a View.
    |
    | Parâmetros:
    | $pagina -> Caminho da View.
    | $dados  -> Variáveis enviadas para a View.
    |--------------------------------------------------------------------------
    */
    protected function view(string $pagina, array $dados = [])
    {

        // Converte cada posição do array em uma variável.
        // Exemplo:
        // ['nome' => 'João']
        // torna-se:
        // $nome = 'João';
        extract($dados);

        // Carrega a página solicitada.
        require $pagina;

    }

    /*
    |--------------------------------------------------------------------------
    | Redirecionamento
    |--------------------------------------------------------------------------
    |
    | Redireciona o navegador para outra página
    | utilizando o cabeçalho HTTP Location.
    |
    | Parâmetro:
    | $url -> Endereço de destino.
    |--------------------------------------------------------------------------
    */
    protected function redirect(string $url)
    {

        // Envia o cabeçalho HTTP de redirecionamento.
        header("Location: {$url}");

        // Encerra imediatamente a execução do script
        // após o redirecionamento.
        exit;

    }

}