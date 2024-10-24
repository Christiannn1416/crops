<?php
require_once('../sistema.class.php');

class Invernadero extends Sistema
{
    function create($data)
    {
        $result = [];
        $this->conexion();
        $sql = "insert into invernadero(invernadero,latitud,longitud,area,fecha_creacion) 
        VALUES( 
        :invernadero, 
        :longitud, 
        :latitud, 
        :area, 
        :fecha_creacion);";
        $insertar = $this->con->prepare($sql);
        $insertar->bindParam(':invernadero', $data['invernadero'], PDO::PARAM_STR);
        $insertar->bindParam(':longitud', $data['longitud'], PDO::PARAM_STR);
        $insertar->bindParam(':latitud', $data['latitud'], PDO::PARAM_STR);
        $insertar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $insertar->bindParam(':fecha_creacion', $data['fecha_creacion'], PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data)
    {
        $this->conexion();
        $result = [];
        $sql = "update invernadero set invernadero=:invernadero, latitud=:latitud, longitud=:longitud,
        area=:area, fecha_creacion=:fecha_creacion where id_invernadero=:id_invernadero;";
        $modificar = $this->con->prepare($sql);
        $modificar->bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $modificar->bindParam(':invernadero', $data['invernadero'], PDO::PARAM_STR);
        $modificar->bindParam(':latitud', $data['latitud'], PDO::PARAM_STR);
        $modificar->bindParam(':longitud', $data['longitud'], PDO::PARAM_STR);
        $modificar->bindParam(':area', $data['area'], PDO::PARAM_INT);
        $modificar->bindParam(':fecha_creacion', $data['fecha_creacion'], PDO::PARAM_STR);
        $modificar->execute();
        $result = $modificar->rowCount();
        return $result;
    }

    function delete($id)
    {
        $result = [];
        $this->conexion();
        $sql = "delete from invernadero where id_invernadero = :id_invernadero";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $borrar->execute();
        $result = $borrar->rowCount();
        return $result;
    }
    function readOne($id)
    {
        $this->conexion();
        $result = [];
        $query = "select * from invernadero where id_invernadero = :id_invernadero;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(":id_invernadero", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll()
    {
        $this->conexion();
        $result = [];
        $query = "select * from invernadero";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>