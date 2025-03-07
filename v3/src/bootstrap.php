<?php
define('APP_ROOT', dirname(__FILE__, 2));
require_once APP_ROOT . '/config/config.php';
require_once APP_ROOT . '/src/functions.php';

spl_autoload_register(function($class) {
    $path = APP_ROOT . '/src/classes/';
    require $path . $class . '.php';
});

if (DEV !== false) {
    set_exception_handler('handle_exception');
    set_error_handler('handle_error');
    register_shutdown_function('handle_shutdown');
}

$cms = new CMS($dsn, $username, $password);
unset($dsn, $username, $password);