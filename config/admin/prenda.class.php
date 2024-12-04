<?php
 require_once ('../sistema.class.php');

 class prenda extends sistema {
    function create ($data){
        $result = [];
        $insertar = [];
        $this -> conexion();
        $sql="insert into prenda (nombre, descripcion, precio, id_categoria, fecha_registro) 
              values(:nombre,:descripcion, :precio, :id_categoria, :fecha_registro);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar -> bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
        $insertar -> bindParam(':precio', $data['precio'], PDO::PARAM_INT);
        $insertar -> bindParam(':id_categoria', $data['id_categoria'], PDO::PARAM_STR);
        $insertar -> bindParam(':fecha_registro', $data['fecha_registro'], PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }

    function update ($id, $data){
        $this->conexion();
        $result = [];
        $sql = 'update prenda set nombre=:nombre, descripcion=:descripcion, precio=:precio,
                 id_categoria=:id_categoria, fecha_registro=:fecha_registro where id_prenda=:id_prenda;';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':id_prenda',$id, PDO::PARAM_INT);
        $modificar->bindParam(':nombre',$data['nombre'], PDO::PARAM_STR);
        $modificar->bindParam(':descripcion',$data['descripcion'], PDO::PARAM_STR);
        $modificar->bindParam(':precio',$data['precio'], PDO::PARAM_INT);
        $modificar->bindParam(':id_categoria',$data['id_categoria'], PDO::PARAM_INT);
        $modificar->bindParam(':fecha_registro',$data['fecha_registro'], PDO::PARAM_STR);
        $modificar->execute();
        $result= $modificar->rowCount();
        return $result;
    }

    function delete ($id){
        $this -> conexion();
        $result = [];
        if (is_numeric($id)) {
            $sql = "delete from prenda where id_prenda=:id_prenda;";
            $eliminar = $this->con->prepare($sql);
            $eliminar -> bindParam(':id_prenda', $id, PDO::PARAM_INT);
            $eliminar -> execute();
            $result = $eliminar -> rowCount();
        }
        return $result;
    }

    function readOne ($id){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM prenda where id_prenda=:id_prenda;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_prenda",$id,PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll (){
        $this -> conexion();
        $result = [];
        $consulta ='select p.*, c.categoria from categoria c join prenda p on c.id_categoria=p.id_categoria;';
        $sql = $this->con->prepare($consulta); 
        $sql -> execute();
        $result = $sql -> fetchALL(PDO::FETCH_ASSOC);    
        return $result;
    }
 }
?>