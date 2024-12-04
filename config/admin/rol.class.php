<?php
 require_once ('../sistema.class.php');

 class rol extends sistema {
    function create ($data){
        $result = [];
        $insertar = [];
        $this -> conexion();
        $sql="insert into rol(rol) values(:rol);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }

    function update ($id, $data){
        $this->conexion();
        $result = [];
        $sql = 'update rol set rol=:rol where id_rol=:id_rol;';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':id_rol',$id, PDO::PARAM_INT);
        $modificar->bindParam(':rol',$data['rol'], PDO::PARAM_STR);
        $modificar->execute();
        $result= $modificar->rowCount();
        return $result;
    }

    function delete ($id){
        $this -> conexion();
        $result = [];
        $sql = "delete from rol where id_rol=:id_rol;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_rol', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }

    function readOne ($id){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM rol where id_rol=:id_rol;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_rol",$id,PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll (){
        $this -> conexion();
        $result = [];
        $consulta ='select * from rol';
        $sql = $this->con->prepare ($consulta); 
        $sql -> execute();
        $result = $sql -> fetchALL(PDO::FETCH_ASSOC);    
        return $result;
    }
 }
?>
