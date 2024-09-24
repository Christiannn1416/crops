<?php
include ('invernadero.class.php');
$app=new Invernadero();
$accion = (isset($_GET['accion']))?$_GET['accion']:NULL;

switch($accion){
    case 'crear':
        include("views/invernadero/crear.php");
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app -> create($data);
        if($resultado){
            $mensaje = "El Invernadero se ha agregado correctamente";
            $tipo = "success";
        }else{
            $mensaje = "Ocurrió un error al agregar";
            $tipo = "danger";
        }
        $invernaderos = $app -> readAll();
        include('views/invernadero/index.php');
        break;
    case 'actualizar':
        break;
    case 'eliminar':
        $id=(isset($_GET['id']))?$_GET['id']:null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $resultado = $app -> delete($id);
                if($resultado){
                    $mensaje = "El Invernadero se ha eliminado correctamente";
                    $tipo = "success";
                }else{
                    $mensaje = "Ocurrió un error";
                    $tipo = "danger";
                }
            }
        }
        $invernaderos = $app -> readAll();
        include("views/invernadero/index.php");
        break;
    default:
        $invernaderos = $app -> readAll();
        include("views/invernadero/index.php");

}
?>