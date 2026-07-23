<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| BaseModel
|--------------------------------------------------------------------------
|
| Classe base utilizada por todos os Models
| do sistema seguindo o padrão MVC.
|
| Responsabilidades:
| - Criar a conexão com o banco de dados.
| - Disponibilizar um método padrão para execução
|   de consultas SQL utilizando PDO.
|
| Todos os Models deverão herdar esta classe,
| reutilizando a conexão e o método de consulta.
|--------------------------------------------------------------------------
*/

//
// Carrega a configuração de conexão
// com o banco de dados.
//
require_once __DIR__ . '/../config/database.php';

abstract class BaseModel
{
    //
    // Objeto responsável pela conexão
    // com o banco de dados.
    //
    protected PDO $db;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Obtém automaticamente a conexão
    | utilizando a classe Database.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /*
    |--------------------------------------------------------------------------
    | Executa uma Consulta SQL
    |--------------------------------------------------------------------------
    |
    | Recebe uma instrução SQL e,
    | opcionalmente, um array contendo
    | os parâmetros da consulta.
    |
    | Funcionamento:
    | - Prepara a consulta.
    | - Executa utilizando os parâmetros.
    | - Retorna o objeto PDOStatement.
    |
    | Parâmetros:
    | $sql    -> Consulta SQL.
    | $params -> Parâmetros da consulta.
    |--------------------------------------------------------------------------
    */
    protected function query(string $sql, array $params = [])
    {
        // Prepara a instrução SQL.
        $stmt = $this->db->prepare($sql);

        // Executa a consulta utilizando
        // os parâmetros informados.
        $stmt->execute($params);

        // Retorna o objeto PDOStatement
        // para utilização pelo Model.
        return $stmt;
    }
}