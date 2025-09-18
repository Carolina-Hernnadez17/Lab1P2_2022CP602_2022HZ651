<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/AutorRCMH.php";

class AutorDAO_RCMH {
    private $conexion;

    public function __construct(){
        $this->conexion = (new ConexionRCMH())->conectarRCMH();
    }

    // Getter público para la conexión
    public function getConexion(){
        return $this->conexion;
    }

    public function agregarRCMH(AutorRCMH $autor){
        $sql = "INSERT INTO autores (nombre, nacionalidad) VALUES (:nombre, :nacionalidad)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'nombre'=>$autor->nombre,
            'nacionalidad'=>$autor->nacionalidad
        ]);
    }

    public function listarRCMH(){
        $sql = "SELECT * FROM autores ORDER BY nombre ASC";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRCMH($id_autor){
        $sql = "SELECT * FROM autores WHERE id_autor=:id_autor";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id_autor'=>$id_autor]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarRCMH(AutorRCMH $autor){
        $sql = "UPDATE autores SET nombre=:nombre, nacionalidad=:nacionalidad WHERE id_autor=:id_autor";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'nombre'=>$autor->nombre,
            'nacionalidad'=>$autor->nacionalidad,
            'id_autor'=>$autor->id_autor
        ]);
    }

    public function eliminarRCMH($id_autor){
        $sql = "DELETE FROM autores WHERE id_autor=:id_autor";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute(['id_autor'=>$id_autor]);
    }
}
?>
