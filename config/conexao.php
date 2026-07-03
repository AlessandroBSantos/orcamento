<?php

$host = "localhost";
$banco = "lla_erp";
$usuario = "lla_erp_user";
$senha = "&KCiM?1sb0HI";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {

    die("Erro na conexão: " . $e->getMessage());

}