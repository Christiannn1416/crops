<?php
include ('../sistema.class.php');

class Seccion extends Sistema{
    function create ($data) {
        $result=[];
        $this -> conexion();
        $sql = "insert into seccion(seccion,area,id_invernadero) 
        VALUES(
        :seccion,
        :area, 
        :id_invernadero);";
        $insertar = $this -> con -> prepare($sql);
        $insertar -> bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
        $insertar -> bindParam(':area',$data['area'],PDO::PARAM_INT);
        $insertar -> bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }
    
    function update($id, $data) {
        $this->conexion();
        $result=[];
        $sql = "UPDATE seccion SET seccion=:seccion, area=:area, 
        id_invernadero=:id_invernadero WHERE id_seccion=:id_seccion;";
        $modificar = $this->con->prepare($sql);
        $modificar -> bindParam(':id_seccion', $id,PDO::PARAM_INT);
        $modificar -> bindParam(':seccion', $data['seccion'],PDO::PARAM_STR);
        $modificar -> bindParam(':area', $data['area'],PDO::PARAM_INT);
        $modificar -> bindParam(':id_invernadero', $data['id_invernadero'],PDO::PARAM_INT);
        $modificar -> execute();
        $result =$modificar->rowCount();
        return $result;
    }

    function delete($id) {
        $result=[];
        $this -> conexion();
        $sql = "delete from seccion where id_seccion = :id_seccion";
        $borrar = $this -> con -> prepare($sql);
        $borrar -> bindParam(':id_seccion',$id,PDO::PARAM_INT);
        $borrar -> execute();
        $result = $borrar -> rowCount();
        return $result;
    }
    function readOne($id) {
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM seccion where id_seccion = :id_seccion;";
        $sql = $this -> con ->prepare($query);
        $sql -> bindParam(":id_seccion", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll(){
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM seccion";
        $sql = $this -> con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>