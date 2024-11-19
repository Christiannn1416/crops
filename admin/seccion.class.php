<?php
declare(strict_types=1);
require_once('../sistema.class.php');
require_once '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;



class Seccion extends Sistema
{
    function create($data)
    {
        $result = [];
        $this->conexion();
        $sql = "insert into seccion(seccion,area,id_invernadero) 
        VALUES(
        :seccion,
        :area, 
        :id_invernadero);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':seccion', $data['seccion'], PDO::PARAM_STR);
        $insertar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $insertar->bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data)
    {
        $this->conexion();
        $result = [];
        $sql = "UPDATE seccion SET seccion=:seccion, area=:area, 
        id_invernadero=:id_invernadero WHERE id_seccion=:id_seccion;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_seccion', $id, PDO::PARAM_INT);
        $modificar->bindParam(':seccion', $data['seccion'], PDO::PARAM_STR);
        $modificar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $modificar->bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id)
    {
        $result = [];
        $this->conexion();
        if (is_numeric($id)) {
            $sql = "delete from seccion where id_seccion = :id_seccion";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_seccion', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
        }
        return $result;
    }
    function readOne($id)
    {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM seccion where id_seccion = :id_seccion;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(":id_seccion", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll()
    {
        $this->conexion();
        $result = [];
        $query = "SELECT s.*,i.invernadero FROM seccion s join invernadero i on s.id_invernadero = i.id_invernadero";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function reporte()
    {
        require_once('../vendor/autoload.php');
        $this->conexion();
        $sql = 'select * from vw_n_invernaderos_seccion;';
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);
        try {
            include('../lib/phpqrcode/qrlib.php');
            $id_factura = rand(1, 1000);
            $file_name = '../qr/' . $id_factura . '.png';
            QRcode::png('https://sourceforge.net/projects/phpqrcode/', $file_name, 2, 20, 2);
            header('Content-Type: text/html; charset=utf-8');
            ob_start();
            $content = ob_get_clean();
            $content = '
        <html>
        <body>
        <div style="text-align:center; margin-bottom: 20px;">
            <img src="../images/logo.png" alt="logo crops" width="250">
            <h1 style="font-family: Arial, sans-serif; color: #333;">Número de Invernaderos por Sección:</h1>
        </div>
        <div style="margin: auto; width: 80%; font-family: Arial, sans-serif; color: #333;">
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
                <tr style="background-color: #4CAF50; color: white;">
                    <th>Sección</th>
                    <th>Número de Invernaderos</th>
                </tr>';
            foreach ($data as $seccion) {
                $content .= '<tr style="background-color: #f2f2f2;">';
                $content .= '<td>' . ($seccion['seccion']) . '</td>';
                $content .= '<td>' . ($seccion['N_Invernaderos']) . '</td>';
                $content .= '</tr>';
            }
            $content .= '</table>
        </div>
        <h1> Tenemos ';
            $content .= $cantidad = sizeof($data);
            $content .= ' Secciones</h1>
            <div>
                <p> Dirección: Av Irrigación 105-3 P · Contacto: 461 612 9727 </p>
            </div>
        </body>
        </html>';

            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('ejemplo.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }

    }
}
?>