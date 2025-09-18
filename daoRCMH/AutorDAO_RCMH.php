<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/AutorRCMH.php";

class AutorDAO_RCMH {
    private $conexion;

    public function __construct() {
        $this->conexion = (new ConexionRCMH())->getConexion();
    }

    public function listar() {
        return $this->conexion->query("SELECT * FROM autores ORDER BY nombre ASC")->fetchAll();
    }

    public function agregar(AutorRCMH $autor) {
        $sql = "INSERT INTO autores (nombre, nacionalidad) VALUES (:nombre, :nacionalidad)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $autor->nombre,
            ':nacionalidad' => $autor->nacionalidad
        ]);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM autores WHERE id_autor = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch();
    }

    public function actualizar(AutorRCMH $autor) {
        $sql = "UPDATE autores SET nombre=:nombre, nacionalidad=:nacionalidad WHERE id_autor=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $autor->nombre,
            ':nacionalidad' => $autor->nacionalidad,
            ':id' => $autor->id
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM autores WHERE id_autor=:id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([':id'=>$id]);
    }
}
?>
