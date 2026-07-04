<?php

abstract class BaseController
{

    protected function view(string $pagina, array $dados = [])
    {

        extract($dados);

        require $pagina;

    }

    protected function redirect(string $url)
    {

        header("Location: {$url}");

        exit;

    }

}