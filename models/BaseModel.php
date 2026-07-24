<?php

require_once __DIR__ . '/../config/database.php';

abstract class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    protected function query(string $sql, array $params = [])
    {
        $stmt = $this->db->prepare($sql);

        try {

            $stmt->execute($params);

        } catch (PDOException $e) {

            echo "<h2>Erro SQL</h2>";

            echo "<h3>Mensagem:</h3>";
            echo "<pre>" . $e->getMessage() . "</pre>";

            echo "<h3>SQL:</h3>";
            echo "<pre>" . htmlspecialchars($sql) . "</pre>";

            echo "<h3>Parâmetros:</h3>";
            echo "<pre>";
            print_r($params);
            echo "</pre>";

            exit;

        }

        return $stmt;
    }
}