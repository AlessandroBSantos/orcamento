<?php

require_once __DIR__ . '/app.php';

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {

            $host = 'localhost';
            $banco = "ales7542_lla_erp";
            $usuario = "ales7542_lla_erp_user";
            $senha = "&KCiM?1sb0HI";

            try {

                self::$connection = new PDO(
                    "mysql:host={$host};dbname={$database};charset=utf8mb4",
                    $user,
                    $password
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                die("Erro ao conectar ao banco: " . $e->getMessage());

            }

        }

        return self::$connection;
    }
}

$host = "localhost";
$banco = "ales7542_lla_erp";
$usuario = "ales7542_lla_erp_user";
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