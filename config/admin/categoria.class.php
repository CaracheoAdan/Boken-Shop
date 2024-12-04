<?php
 require_once ('../sistema.class.php');

 class categoria extends sistema {
    function create ($data){
        $result = [];
        $insertar = [];
        $this -> conexion();
        $sql="insert into categoria(categoria) values(:categoria);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':categoria', $data['categoria'], PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }

    function update ($id, $data){
        $this->conexion();
        $result = [];
        $sql = 'update categoria set categoria=:categoria where id_categoria=:id_categoria;';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':id_categoria',$id, PDO::PARAM_INT);
        $modificar->bindParam(':categoria',$data['categoria'], PDO::PARAM_STR);
        $modificar->execute();
        $result= $modificar->rowCount();
        return $result;
    }

    function delete ($id){
        $this -> conexion();
        $result = [];
        $sql = "delete from categoria where id_categoria=:id_categoria;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_categoria', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }

    function readOne ($id){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM categoria where id_categoria=:id_categoria;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_categoria",$id,PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll (){
        $this -> conexion();
        $result = [];
        $consulta ='select * from categoria';
        $sql = $this->con->prepare ($consulta); 
        $sql -> execute();
        $result = $sql -> fetchALL(PDO::FETCH_ASSOC);    
        return $result;
    }
 }
?>