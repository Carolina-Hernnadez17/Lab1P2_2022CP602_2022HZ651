<?php
require_once "configRCMH/ConexionRCMH.php";
require_once "modelosRCMH/CategoriaRCMH.php";

class CategoriaDAO_RCMH {
    private $conexion;

    public function __construct(){
        $this->conexion = (new ConexionRCMH())->conectarRCMH();
    }

    // Getter público para la conexión
    public function getConexion(){
        return $this->conexion;
    }

    public function agregarRCMH(CategoriaRCMH $categoria){
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'nombre'=>$categoria->nombre
        ]);
    }

    public function listarRCMH(){
        $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
        return $this->conexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRCMH($id_categoria){
        $sql = "SELECT * FROM categorias WHERE id_categoria=:id_categoria";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id_categoria'=>$id_categoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarRCMH(CategoriaRCMH $categoria){
        $sql = "UPDATE categorias SET nombre=:nombre WHERE id_categoria=:id_categoria";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            'nombre'=>$categoria->nombre,
            'id_categoria'=>$categoria->id_categoria
        ]);
    }

    public function eliminarRCMH($id_categoria){
        $sql = "DELETE FROM categorias WHERE id_categoria=:id_categoria";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute(['id_categoria'=>$id_categoria]);
    }

    // Obtener número de libros asociados a la categoría
    public function contarLibrosRCMH($id_categoria){
        $sql = "SELECT COUNT(*) FROM libros_categorias WHERE id_categoria=:id_categoria";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(['id_categoria'=>$id_categoria]);
        return $stmt->fetchColumn();
    }
}
?>
