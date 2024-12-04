<?php

/* Errors */
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log',"C:/xampp/htdocs/serviunix/php_error_log");
// Cargar el autoload de Composer
require __DIR__ . '/vendor/autoload.php';

// Iniciar la configuración de Eloquent
use App\Core\Eloquent;
Eloquent::boot();

// Incluir las rutas
require __DIR__ . '/routes/routes.php'; 
