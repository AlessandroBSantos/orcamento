<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Configuração de Conexão com o Banco de Dados
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por criar e disponibilizar
| uma única conexão com o banco de dados utilizando PDO.
|
| Características:
| - Utiliza o padrão Singleton.
| - Cria apenas uma conexão durante toda a execução.
| - Configura tratamento de erros por exceção.
| - Define o modo padrão de retorno como array associativo.
|
|--------------------------------------------------------------------------
*/

//
// Carrega as configurações gerais do sistema.
//
require_once __DIR__ . '/app.php';

class Database
{
    //
    // Armazena a instância única da conexão.
    // Enquanto for nula, uma nova conexão será criada.
    //
    private static ?PDO $connection = null;

    //
    // Retorna a conexão com o banco de dados.
    // Caso ainda não exista, cria uma nova conexão.
    //
    public static function getConnection(): PDO
    {
        //
        // Verifica se a conexão ainda não foi criada.
        //
        if (self::$connection === null) {

            //
            // Servidor do banco de dados.
            //
            $host = "localhost";

            //
            // Nome do banco de dados.
            //
            $banco = "ales7542_lla_erp";

            //
            // Usuário do banco.
            //
            $usuario = "ales7542_lla_erp_user";

            //
            // Senha do banco.
            //
            $senha = "&KCiM?1sb0HI";

            try {

                //
                // Cria uma nova conexão PDO
                // utilizando o banco MySQL.
                //
                self::$connection = new PDO(
                    "mysql:host={$host};dbname={$banco};charset=utf8mb4",
                    $usuario,
                    $senha
                );

                //
                // Configura o PDO para lançar exceções
                // sempre que ocorrer algum erro.
                //
                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                //
                // Define que todas as consultas
                // retornarão arrays associativos.
                //
                self::$connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                //
                // Exibe a mensagem de erro caso
                // não seja possível conectar ao banco.
                //
                die("Erro ao conectar ao banco: " . $e->getMessage());

            }

        }

        //
        // Retorna a conexão existente.
        //
        return self::$connection;
    }
}