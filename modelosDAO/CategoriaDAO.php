<?php
require_once "config/conexion.php";
require_once "modelos/Categoria.php";

class CategoriaDAO {
    private $cn;

    public function __construct() {
        $this->cn = new ConexionRCMH();
    }

    public function getAll() {
        $results = $this->cn->consulta("SELECT * FROM categorias ORDER BY nombre ASC");
        $categorias = [];
        foreach($results as $r){
            $categorias[] = new Categoria($r['id_categoria'], $r['nombre']);
        }
        return $categorias;
    }

    public function getById($id) {
        $results = $this->cn->consulta("SELECT * FROM categorias WHERE id_categoria=:id", [":id"=>$id]);
        if(count($results) > 0){
            $r = $results[0];
            return new Categoria($r['id_categoria'], $r['nombre']);
        }
        return null;
    }

    public function add(Categoria $c) {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        return $this->cn->ejecutar($sql, [":nombre"=>$c->getNombre()]);
    }

    public function update(Categoria $c) {
        $sql = "UPDATE categorias SET nombre=:nombre WHERE id_categoria=:id";
        return $this->cn->ejecutar($sql, [":nombre"=>$c->getNombre(), ":id"=>$c->getId()]);
    }

    public function delete($id) {
        return $this->cn->ejecutar("DELETE FROM categorias WHERE id_categoria=:id", [":id"=>$id]);
    }
}
?>
