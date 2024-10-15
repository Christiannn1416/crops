<?php
require('views/header.php');
require_once('../sistema.class.php');

$app = new Sistema();
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;

switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contrasena = $_POST['data']['contrasena'];
        if ($app->login($correo, $contrasena)) {
            echo ('Bienvenido al Sistemas');
            echo ('<pre>');
            print_r($_SESSION);
            die();
        } else {
            echo ('Acceso Denegado');
        }
        break;

    case 'logout':
        $app->logout();
        break;

    default:
        include('views/login/index.php');
        break;
}


?>