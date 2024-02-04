<?php
    session_start();

    define('ABS_PATH', dirname(__FILE__, 3));

    $config = parse_ini_file(ABS_PATH . '/config.ini', true);
    $environment = $config['ENVIRONMENT'];
    $URL_BASE = $config[$environment]['URL_BASE'];

    define('URL_PATH', $URL_BASE);

    unset($_SESSION['username']);

    header('Location: ' . URL_PATH . '/index.php');
    exit;
?>