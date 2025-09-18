<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/CategoriaRCMH.php";

class CategoriaDAO_RCMH {
    private $conexion;

    public function __construct() {
        $this->conexion = (new ConexionRCMH())->getConexion();
    }

    public function listar() {
        return $this->conexion->query("SELECT * FROM categorias ORDER BY nombre ASC")->fetchAll();
    }

    public function agregar(CategoriaRCMH $categoria) {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':nombre'=>$categoria->nombre]);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM categorias WHERE id_categoria=:id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch();
    }

    public function actualizar(CategoriaRCMH $categoria) {
        $sql = "UPDATE categorias SET nombre=:nombre WHERE id_categoria=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre'=>$categoria->nombre,
            ':id'=>$categoria->id
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM categorias WHERE id_categoria=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id'=>$id]);
    }
}
?>
