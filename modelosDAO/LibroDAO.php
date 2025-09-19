<?php
require_once "config/conexion.php";
require_once "modelos/Libro.php";

class LibroDAO {
    private $cn;

    public function __construct() {
        $this->cn = new ConexionRCMH();
    }

    public function getAll() {
        $results = $this->cn->consulta("SELECT * FROM libros ORDER BY titulo ASC");
        $libros = [];
        foreach($results as $r){
            $libros[] = new Libro($r['id_libro'], $r['titulo'], $r['id_autor'], $r['portada'], $r['disponible'] ?? 1);
        }
        return $libros;
    }

    public function getById($id) {
        $results = $this->cn->consulta("SELECT * FROM libros WHERE id_libro=:id", [":id"=>$id]);
        if(count($results) > 0){
            $r = $results[0];
            return new Libro($r['id_libro'], $r['titulo'], $r['id_autor'], $r['portada'], $r['disponible'] ?? 1);
        }
        return null;
    }

    public function add(Libro $l) {
        $sql = "INSERT INTO libros (titulo, id_autor, portada, disponible) 
                VALUES (:titulo, :id_autor, :portada, :disponible)";
        return $this->cn->ejecutar($sql, [
            ":titulo"=>$l->getTitulo(),
            ":id_autor"=>$l->getIdAutor(),
            ":portada"=>$l->getPortada(),
            ":disponible"=>$l->getDisponible()
        ]);
    }

    public function update(Libro $l) {
        $sql = "UPDATE libros SET titulo=:titulo, id_autor=:id_autor, portada=:portada, disponible=:disponible 
                WHERE id_libro=:id";
        return $this->cn->ejecutar($sql, [
            ":titulo"=>$l->getTitulo(),
            ":id_autor"=>$l->getIdAutor(),
            ":portada"=>$l->getPortada(),
            ":disponible"=>$l->getDisponible(),
            ":id"=>$l->getId()
        ]);
    }

    public function delete($id) {
        return $this->cn->ejecutar("DELETE FROM libros WHERE id_libro=:id", [":id"=>$id]);
    }
}
?>
