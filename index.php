<?php

switch ($_SERVER['REQUEST_URI']) {
    case '/php_files':
        include 'php_files/php_files.php';
        break;
    case '/prod':
        include 'prod/prod.php';
        break;
    case '/ads.txt':
        include 'ads.txt';
        break;
    case '/':
        include 'home.php';
        break;
    default:
        include '404.php';
        break;
}
?>