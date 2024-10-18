<?php
require_once('invernadero.class.php');
$app = new Invernadero();
$app->checkRol('administrador');
$accion = (isset($_GET['accion'])) ? $_GET['accion'] : NULL;

$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        require_once("views/invernadero/crear.php");
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app->create($data);
        if ($resultado) {
            $mensaje = "El Invernadero se ha agregado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $invernaderos = $app->readAll();
        require_once('views/invernadero/index.php');
        break;
    case 'actualizar':
        $invernaderos = $app->readOne($id);
        require_once('views/invernadero/crear.php');
        break;

    case 'modificar':
        $data = $_POST['data'];
        $resultado = $app->update($id, $data);
        if ($resultado) {
            $mensaje = "El Invernadero se ha actualizado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Ocurrió un error al actualizar";
            $tipo = "danger";
        }
        $invernaderos = $app->readAll();
        require_once('views/invernadero/index.php');
        break;
    case 'eliminar':
        if (!is_null($id)) {
            if (is_numeric($id)) {
                $resultado = $app->delete($id);
                if ($resultado) {
                    $mensaje = "El Invernadero se ha eliminado correctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $invernaderos = $app->readAll();
        require_once("views/invernadero/index.php");
        break;
    default:
        $invernaderos = $app->readAll();
        require_once("views/invernadero/index.php");

}
require_once('views/footer.php');
?>