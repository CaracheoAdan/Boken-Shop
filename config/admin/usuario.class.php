<?php
 require_once ('../sistema.class.php');

 class usuario extends sistema {
    function create ($data){
        $result = [];
        $insertar = [];
        $this -> conexion();
        $rol = $data['rol'];
        $data = $data['data'];
        $this -> con -> beginTransaction();

        try {
          $sql="insert into usuario(correo, contrasena) values(:correo, md5(:contrasena));";
          $insertar = $this->con->prepare($sql);
          $insertar -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
          $insertar -> bindParam(':contrasena', $data['contrasena'], PDO::PARAM_STR);
          $insertar -> execute();

          $sql = "select id_usuario from usuario where correo = :correo";
          $consulta = $this->con->prepare($sql);
          $consulta -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
          $consulta -> execute();

          $datos = $consulta -> fetch(PDO::FETCH_ASSOC);
          $id_usuario = isset($datos['id_usuario'])? $datos['id_usuario']: null;

          if (!is_null($id_usuario)) {
            foreach($rol as $r => $k) {
              $sql = "insert into usuario_rol(id_usuario, id_rol) values(:id_usuario, :id_rol);";
              $insertar_rol = $this->con->prepare($sql);
              $insertar_rol -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
              $insertar_rol -> bindParam(':id_rol', $r, PDO::PARAM_INT);
              $insertar_rol -> execute();
            }

            $this -> con -> commit();
            $result = $insertar -> rowCount();
          }
         
          return $result;
        } catch(Exception $e) {
          $this -> con -> rollback();
        }
        return false;
    }

    function update ($id, $data){
        $this->conexion();
        $rol = $data['rol'];
        $data = $data['data'];
        $this -> con -> beginTransaction();
        try {
          $sql = 'update usuario set correo = :correo, contrasena = md5(:contrasena) where id_usuario = :id_usuario;';
          $modificar=$this->con->prepare($sql);
          $modificar->bindParam(':correo',$data['correo'], PDO::PARAM_STR);
          $modificar->bindParam(':contrasena',$data['contrasena'], PDO::PARAM_STR);
          $modificar->bindParam(':id_usuario',$id, PDO::PARAM_INT);
          $modificar->execute();

          $sql = "delete from usuario_rol where id_usuario = :id_usuario;";
          $borrar_rol = $this -> con -> prepare($sql);
          $borrar_rol -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
          $borrar_rol -> execute();

          if (!is_null($id)) {
            foreach($rol as $r => $k) {
              $sql = "insert into usuario_rol(id_usuario, id_rol) values(:id_usuario, :id_rol);";
              $insertar_rol = $this->con->prepare($sql);
              $insertar_rol -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
              $insertar_rol -> bindParam(':id_rol', $r, PDO::PARAM_INT);
              $insertar_rol -> execute();
            }

            $this -> con ->commit();
            return $insertar_rol -> rowCount();
          }
        } catch (Exception $e) {
          $this -> con -> rollback();
          echo $e -> getMessage();
        }

        return false;
    }

    function delete ($id){
        $this -> conexion();
        $this -> con -> beginTransaction();
        $result = [];
        if (!is_null($id) && is_numeric($id)) {
          try {
            $sql = 'delete from usuario_rol where id_usuario = :id_usuario;';
            $deleteRoles = $this -> con -> prepare($sql);
            $deleteRoles -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $deleteRoles -> execute();

            $sql = "delete from usuario where id_usuario=:id_usuario;";
            $eliminar = $this->con->prepare($sql);
            $eliminar -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $eliminar -> execute();

            $this -> con -> commit();
            return $eliminar -> rowCount();
          } catch (Exception $e) {
            $this -> con -> rollBack();
            echo $e -> getMessage();
          }
        }

        return false;
    }

    function readOne ($id){
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM usuario where id_usuario=:id_usuario;';
        $sql = $this->con->prepare($consulta);
        $sql->bindParam(":id_usuario",$id,PDO::PARAM_INT);
        $sql -> execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll (){
        $this -> conexion();
        $result = [];
        $consulta ='select * from usuario;';
        $sql = $this->con->prepare ($consulta); 
        $sql -> execute();
        $result = $sql -> fetchALL(PDO::FETCH_ASSOC);    
        return $result;
    }

    function readAllRoles($id){
        $this -> conexion();
        $result = [];
        $sql ='select distinct r.id_rol from usuario u inner join usuario_rol ur on u.id_usuario=ur.id_usuario inner join rol r on ur.id_rol = r.id_rol where u.id_usuario = :id_usuario;';
        $consulta = $this->con->prepare ($sql); 
        $consulta->bindParam(":id_usuario",$id,PDO::PARAM_INT);
        $consulta -> execute();
        // $result = $consulta -> fetchALL(PDO::FETCH_ASSOC);

        $roles = [];
        $roles = $consulta -> fetchALL(PDO::FETCH_ASSOC);
        $data = [];
        foreach ($roles as $rol) {
          array_push($data, $rol['id_rol']);
        }

        return $data;
    }
 }
?>