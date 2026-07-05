<?php

require_once '../../includes/auth.php';
require_once '../../controllers/ClienteController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: index.php');
    exit;

}

$controller = new ClienteController();

$resultado = $controller->salvar($_POST);

if ($resultado) {

    header('Location: index.php?sucesso=1');
    exit;

}

header('Location: novo.php?erro=1');
exit;