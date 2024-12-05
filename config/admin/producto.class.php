<?php
require_once ('../sistema.class.php');

class productos extends sistema {
    function create($data) {
        $result = 0;
        $this->conexion();
        $sql = "INSERT INTO productos (nombre, descripcion, precio, descuento, id_categoria, activo) 
                VALUES (:nombre, :descripcion, :precio, :descuento, :id_categoria, :activo);";

        try {
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $insertar->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $insertar->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $insertar->bindParam(':descuento', $data['descuento'], PDO::PARAM_INT);
            $insertar->bindParam(':id_categoria', $data['id_categoria'], PDO::PARAM_INT);
            $insertar->bindParam(':activo', $data['activo'], PDO::PARAM_INT);

            $insertar->execute();
            $result = $insertar->rowCount();
        } catch (PDOException $e) {
            error_log("Error al insertar producto: " . $e->getMessage());
        }

        return $result;
    }

    function update($id, $data) {
        $result = 0;
        $this->conexion();
        $sql = 'UPDATE productos 
                SET nombre=:nombre, 
                    descripcion=:descripcion, 
                    precio=:precio, 
                    descuento=:descuento, 
                    id_categoria=:id_categoria, 
                    activo=:activo 
                WHERE id=:id;';

        try {
            $modificar = $this->con->prepare($sql);
            $modificar->bindParam(':id', $id, PDO::PARAM_INT);
            $modificar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
            $modificar->bindParam(':descripcion', $data['descripcion'], PDO::PARAM_STR);
            $modificar->bindParam(':precio', $data['precio'], PDO::PARAM_STR);
            $modificar->bindParam(':descuento', $data['descuento'], PDO::PARAM_INT);
            $modificar->bindParam(':id_categoria', $data['id_categoria'], PDO::PARAM_INT);
            $modificar->bindParam(':activo', $data['activo'], PDO::PARAM_INT);

            $modificar->execute();
            $result = $modificar->rowCount();
        } catch (PDOException $e) {
            error_log("Error al actualizar producto: " . $e->getMessage());
        }

        return $result;
    }

    function delete($id) {
        $result = 0;
        $this->conexion();

        if (is_numeric($id)) {
            $sql = "DELETE FROM productos WHERE id=:id;";
            try {
                $eliminar = $this->con->prepare($sql);
                $eliminar->bindParam(':id', $id, PDO::PARAM_INT);
                $eliminar->execute();
                $result = $eliminar->rowCount();
            } catch (PDOException $e) {
                error_log("Error al eliminar producto: " . $e->getMessage());
            }
        }

        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT * FROM productos WHERE id=:id;';

        try {
            $sql = $this->con->prepare($consulta);
            $sql->bindParam(":id", $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al leer producto: " . $e->getMessage());
        }

        return $result;
    }

    function readAll() {
        $this->conexion();
        $result = [];
        $consulta = 'SELECT p.*, c.categoria 
                     FROM categoria c 
                     JOIN productos p ON c.id_categoria = p.id_categoria;';

        try {
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al leer productos: " . $e->getMessage());
        }

        return $result;
    }
}
?>
