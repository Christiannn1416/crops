<?php
require_once('../sistema.class.php');

class Usuario extends Sistema
{
    function create($data)
    {
        $this->conexion();
        $data = $data['data'];
        $this->con->beginTransaction();
        $sql = "insert into usuario (correo, contrasena) values (:correo, :contrasena)";
        $insertar = $this->con->prepare($sql);
        $data['contrasena'] = md5($data['contrasena']); // Encriptar la contraseña con MD5
        $insertar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $insertar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
        $insertar->execute();
        $this->con->commit();
        return $insertar->rowCount();
    }

    function update($id, $data)
    {
        $this->conexion();
        $sql = "update usuario set correo = :correo, contrasena = :contrasena where id_usuario = :id_usuario";
        $modificar = $this->con->prepare($sql);
        $data['contrasena'] = md5($data['contrasena']); // Encriptar la contraseña con MD5
        $modificar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $modificar->bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $modificar->bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
        $modificar->execute();
        return $modificar->rowCount();
    }

    function delete($id)
    {
        $this->conexion();
        $sql = "delete from usuario where id_usuario = :id_usuario";
        $borrar = $this->con->prepare($sql);
        $borrar->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $borrar->execute();
        return $borrar->rowCount();
    }

    function readOne($id)
    {
        $this->conexion();
        $sql = "select * from usuario where id_usuario = :id_usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    function readAll()
    {
        $this->conexion();
        $sql = "select * from usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>