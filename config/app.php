<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Configurações gerais do sistema
|--------------------------------------------------------------------------
| Este arquivo centraliza as configurações globais
| utilizadas em todo o sistema.
|
| Responsabilidades:
| - Configuração do fuso horário.
| - Inicialização da sessão.
| - Definição de constantes da aplicação.
| - Configuração de caminhos e URLs.
| - Configuração do tema padrão.
| - Definição do idioma do sistema.
|--------------------------------------------------------------------------
*/

//
// Define o fuso horário padrão utilizado
// em todas as funções de data e hora.
//
date_default_timezone_set('America/Sao_Paulo');

//
// Verifica se já existe uma sessão ativa.
// Caso contrário, inicia uma nova sessão.
//
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//
// Nome da aplicação.
//
define('APP_NAME', 'LLA ERP');

//
// Versão atual do sistema.
//
define('APP_VERSION', '1.0.0');

//
// Desenvolvedor responsável pelo sistema.
//
define('APP_AUTHOR', 'LLA Software');

//
// URL base utilizada para gerar links internos.
//
// Exemplo:
// http://servidor/orcamento
//
define('BASE_URL', '/orcamento');

//
// Caminho físico da pasta onde serão
// armazenados os arquivos enviados
// pelos usuários (uploads).
//
define('UPLOAD_PATH', __DIR__ . '/../assets/uploads/');

//
// URL pública utilizada para acessar
// os arquivos armazenados na pasta uploads.
//
define('UPLOAD_URL', BASE_URL . '/assets/uploads');

//
// Tema padrão carregado pelo sistema.
//
define('DEFAULT_THEME', 'dark');

//
// Idioma padrão utilizado pela aplicação.
//
define('LANGUAGE', 'pt-BR');