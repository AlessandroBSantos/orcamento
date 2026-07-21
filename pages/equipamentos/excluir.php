<?php

require_once '../../controllers/EquipamentosController.php';

$controller = new EquipamentosController();

if (!isset($_GET['id'])) {

    header("Location: index.php");
    exit;

}

try {

    $controller->excluir((int)$_GET['id']);

    header("Location: index.php?sucesso=excluido");

} catch (Exception $e) {

    header("Location: index.php?erro=" . urlencode($e->getMessage()));

}

exit;