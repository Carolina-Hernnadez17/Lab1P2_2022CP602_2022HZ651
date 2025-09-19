<?php
require_once "config/conexion.php";
require_once "modelos/Autor.php";

class AutorDAO {
    private $cn;

    public function __construct() {
        $this->cn = new ConexionRCMH();
    }

    public function getAll() {
        $results = $this->cn->consulta("SELECT * FROM autores ORDER BY nombre ASC");
        $autores = [];
        foreach($results as $r){
            $autores[] = new Autor($r['id_autor'], $r['nombre'], $r['nacionalidad']);
        }
        return $autores;
    }

    public function getById($id) {
        $results = $this->cn->consulta("SELECT * FROM autores WHERE id_autor = :id", [":id"=>$id]);
        if(count($results) > 0){
            $r = $results[0];
            return new Autor($r['id_autor'], $r['nombre'], $r['nacionalidad']);
        }
        return null;
    }

    public function add(Autor $autor) {
        $sql = "INSERT INTO autores (nombre, nacionalidad) VALUES (:nombre, :nacionalidad)";
        return $this->cn->ejecutar($sql, [
            ":nombre" => $autor->getNombre(),
            ":nacionalidad" => $autor->getNacionalidad()
        ]);
    }

    public function update(Autor $autor) {
        $sql = "UPDATE autores SET nombre=:nombre, nacionalidad=:nacionalidad WHERE id_autor=:id";
        return $this->cn->ejecutar($sql, [
            ":nombre"=>$autor->getNombre(),
            ":nacionalidad"=>$autor->getNacionalidad(),
            ":id"=>$autor->getId()
        ]);
    }

    public function delete($id) {
        return $this->cn->ejecutar("DELETE FROM autores WHERE id_autor=:id", [":id"=>$id]);
    }
}
?>
