<?php

require_once '../../controllers/ClienteController.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {

    header("Location: index.php");
    exit;

}

$id = (int) $_GET['id'];

$controller = new ClienteController();

$resultado = $controller->excluir($id);

if ($resultado) {

    header("Location: index.php?sucesso=excluido");
    exit;

}

header("Location: index.php?erro=1");
exit;