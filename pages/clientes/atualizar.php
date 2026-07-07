<?php

require_once '../../controllers/ClienteController.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    header("Location: index.php");
    exit;

}

$controller = new ClienteController();

$resultado = $controller->atualizar($_POST);

if ($resultado) {

    header("Location: index.php?sucesso=editado");
    exit;

}

header("Location: editar.php?id=" . $_POST['id'] . "&erro=1");
exit;