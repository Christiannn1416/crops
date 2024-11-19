<?php
require_once('../sistema.class.php');
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Empleado extends Sistema
{
    function create($data)
    {
        $result = [];
        $this->conexion();
        $sql = "insert into empleado(primer_apellido,segundo_apellido,nombre,rfc,fotografia,id_usuario)values(
                                    :primer_apellido,
                                    :segundo_apellido,
                                    :nombre,
                                    :rfc,
                                    :fotografia,
                                    :id_usuario);";
        $insertar = $this->con->prepare($sql);
        $fotografia = $this->uploadFoto();
        $insertar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        $insertar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        $insertar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data)
    {
        $this->conexion();
        $result = [];
        $tmp = "";
        if ($_FILES['fotografia']['error'] != 4) {
            $fotografia = $this->uploadFoto();
            $tmp = "fotografia=:fotografia,";
        }
        $sql = 'update empleado set primer_apellido=:primer_apellido, 
                                            segundo_apellido=:segundo_apellido,
                                            nombre=:nombre,
                                            rfc=:rfc,
                                            ' . $tmp . '
                                            id_usuario=:id_usuario
                                            where id_empleado=:id_empleado';
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        if ($_FILES['fotografia']['error'] != 4) {
            $modificar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        }
        $modificar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $modificar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $modificar->execute();
        $result = $modificar->rowCount();

        return $result;
    }

    function delete($id)
    {
        $result = [];
        $this->conexion();
        $sql = "delete from empleado where id_empleado = :id_empleado";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }
    function readOne($id)
    {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM empleado where id_empleado = :id_empleado;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(":id_empleado", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll()
    {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM empleado";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function uploadFoto()
    {
        $tipos = array("image/jpeg", "image/png", "image/gif");
        $data = $_FILES['fotografia'];
        $default = "default.png";
        if ($data['error'] == 0) {
            if ($data['size'] <= 1048576) {
                if (in_array($data['type'], $tipos)) {
                    $n = rand(1, 1000000);
                    $nombre = explode('.', $data['name']);
                    $imagen = md5($n . $nombre[0]) . "." . $nombre[sizeof($nombre) - 1];
                    $origen = $data['tmp_name'];
                    $destino = "C:\\wamp64\\www\\crops\\uploads\\" . $imagen;
                    if (move_uploaded_file($origen, $destino)) {
                        return $imagen;
                    }
                    return $default;
                }
            }
        }
        return $default;
    }

    function reporte($id)
    {
        require_once '../vendor/autoload.php';
        $this->conexion();
        $sql = "SELECT e.primer_apellido, e.segundo_apellido, e.nombre, e.rfc, u.correo, e.fotografia 
                FROM empleado e 
                JOIN usuario u ON e.id_usuario = u.id_usuario
                WHERE e.id_empleado = :id_empleado";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $consulta->execute();
        $empleado = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$empleado) {
            echo "No se encontró el empleado con ID: $id";
            exit;
        }

        try {
            include('../lib/phpqrcode/qrlib.php');
            $editar = '../qr/editarempleado' . $id . '.png';
            QRcode::png('http://localhost/crops/admin/empleado.php?accion=actualizar&id=' . $id, $editar, 2, 15, 2);
            $eliminar = '../qr/eliminarempleado' . $id . '.png';
            QRcode::png('http://localhost/crops/admin/empleado.php?accion=eliminar&id=' . $id, $eliminar, 2, 15, 2);
            ob_start();
            $content = ob_get_clean();
            $content = '
            <html>
            <body style="font-family: Arial, sans-serif; color: #333;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="../images/logo.png" alt="Logo" style="width: 150px; height: auto;">
                </div>
                <h1 style="text-align: center; color: green;">Información del Empleado</h1>
                <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <tr>
                        <th style="background-color: green; color: white; padding: 10px;">Campo</th>
                        <th style="background-color: green; color: white; padding: 10px;">Valor</th>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Primer Apellido</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($empleado['primer_apellido']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Segundo Apellido</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($empleado['segundo_apellido']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Nombre</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($empleado['nombre']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">RFC</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($empleado['rfc']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Correo</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">' . htmlspecialchars($empleado['correo']) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">Fotografía</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">';

            if (!empty($empleado['fotografia'])) {
                $content .= '<img src="../uploads/' . htmlspecialchars($empleado['fotografia']) . '" width="150" height="150" alt="Foto">';
            } else {
                $content .= 'Sin foto';
            }

            $content .= '
                        </td>
                    </tr>
                </table>
                <div>
                    <p>Actualizar</p>
                    <img src="../qr/editarempleado' . $id . '.png">
                </div>
                <div>
                    <p>Elimnar</p>
                    <img src="../qr/eliminarempleado' . $id . '.png">
                </div>
            </body>
            </html>';

            $html2pdf = new Html2Pdf('P', 'A4', 'es');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('empleado_' . $id . '.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
}
?>