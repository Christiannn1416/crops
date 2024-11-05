<?php
require_once('empleado.class.php');
require_once('usuario.class.php');
$app = new Empleado();
$appusuario = new Usuario();
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $usuarios = $appusuario->readAll();
        require_once("views/empleado/crear.php");
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El empleado se ha agregado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        require_once('views/empleado/index.php');
        break;
    case 'actualizar':
        $empleados = $app->readOne($id);
        $usuarios = $appusuario->readAll();
        require_once('views/empleado/crear.php');
        break;

    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El empleado se ha actualizado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al actualizar";
            $tipo = "danger";
        }
        $empleados = $app->readAll();
        require_once('views/empleado/index.php');
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El empleado se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $empleados = $app->readAll();
        require_once("views/empleado/index.php");
        break;
    default:
        $empleados = $app->readAll();
        require_once("views/empleado/index.php");

}
?>