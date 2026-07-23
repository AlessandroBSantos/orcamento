<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Configurações gerais do sistema
|--------------------------------------------------------------------------
*/

date_default_timezone_set('America/Sao_Paulo');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'LLA ERP');
define('APP_VERSION', '1.0.0');
define('APP_AUTHOR', 'LLA Software');

define('BASE_URL', '/orcamento');

define('UPLOAD_PATH', __DIR__ . '/../assets/uploads/');
define('UPLOAD_URL', BASE_URL . '/assets/uploads');

define('DEFAULT_THEME', 'dark');

define('LANGUAGE', 'pt-BR');