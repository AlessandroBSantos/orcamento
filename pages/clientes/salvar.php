<?php

require_once '../../includes/auth.php';

echo "<h2>Dados recebidos do formulário</h2>";

echo "<pre>";

print_r($_POST);

echo "</pre>";

echo "<hr>";

if (empty($_POST)) {

    echo "<h3 style='color:red'>Nenhum dado foi enviado pelo formulário.</h3>";

} else {

    echo "<h3 style='color:green'>Formulário enviado com sucesso.</h3>";

}