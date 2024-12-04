<?php
 require_once ('../sistema.class.php');

 class permiso extends sistema {
    function create ($data){
        $result = [];
        $insertar = [];
        $this -> conexion();
        $sql="insert into permiso(permiso) values(:permiso);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }

    function update ($id, $data){
        $this->conexion();
        $result = [];
        $sql = 'update permiso set permiso=:permiso where id_permiso=:id_permiso;';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':id_permiso',$id, PDO::PARAM_INT);
        $modificar->bindParam(':permiso',$data['permiso'], PDO::PARAM_STR);
        $modificar->execute();
        $result= $modificar->rowCount();
        return $result;
    }

    function delete ($id){
        $this -> conexion();
        $result = [];
        $sql = "delete from permiso where id_permiso=:id_permiso;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }

    function readOne ($id){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM permiso where id_permiso=:id_permiso;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_permiso",$id,PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll (){
        $this -> conexion();
        $result = [];
        $consulta ='select * from permiso';
        $sql = $this->con->prepare ($consulta); 
        $sql -> execute();
        $result = $sql -> fetchALL(PDO::FETCH_ASSOC);    
        return $result;
    }
 }
?>
