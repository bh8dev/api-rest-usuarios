<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

define('HOST', 'localhost');
define('DB_NAME', 'api_usuarios');
define('DB_USER', 'root');
define('DB_PASSWD', '');
define('DB_OPTIONS', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

define('DS', DIRECTORY_SEPARATOR);
define('BASE_DIR', __DIR__);
define('PROJECT_DIR', 'api-usuarios');