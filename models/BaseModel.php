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

    echo "<pre>";
    echo $sql;
    echo "\n\n";

    print_r($params);

    die($e->getMessage());

}

return $stmt;
    }
}