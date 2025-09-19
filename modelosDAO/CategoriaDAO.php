<?php
require_once "config/conexion.php";
require_once "modelos/Categoria.php";

class CategoriaDAO {
    private $cn;
    public function __construct(){ $this->cn = (new ConexionRCMH())->conectarRCMH(); }

    public function getAll(){
        $stmt = $this->cn->query("SELECT * FROM categorias ORDER BY nombre ASC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cats = [];
        foreach($data as $d) $cats[] = new Categoria($d['id_categoria'],$d['nombre']);
        return $cats;
    }

    public function getById($id){
        $stmt = $this->cn->prepare("SELECT * FROM categorias WHERE id_categoria=:id");
        $stmt->execute(['id'=>$id]);
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        if($d) return new Categoria($d['id_categoria'],$d['nombre']);
        return null;
    }

    public function add(Categoria $c){
        $stmt = $this->cn->prepare("INSERT INTO categorias(nombre) VALUES(:n)");
        return $stmt->execute(['n'=>$c->getNombre()]);
    }

    public function update(Categoria $c){
        $stmt = $this->cn->prepare("UPDATE categorias SET nombre=:n WHERE id_categoria=:id");
        return $stmt->execute(['n'=>$c->getNombre(),'id'=>$c->getId()]);
    }

    public function delete($id){
        $stmt = $this->cn->prepare("DELETE FROM categorias WHERE id_categoria=:id");
        return $stmt->execute(['id'=>$id]);
    }
}
?>
