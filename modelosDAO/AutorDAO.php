<?php
require_once "config/conexion.php";
require_once "modelos/Autor.php";

class AutorDAO {
    private $cn;
    public function __construct(){ $this->cn = (new ConexionRCMH())->conectarRCMH(); }

    public function getAll(){
        $stmt = $this->cn->query("SELECT * FROM autores ORDER BY nombre ASC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $autores = [];
        foreach($data as $d){
            $autores[] = new Autor($d['id_autor'], $d['nombre'], $d['nacionalidad']);
        }
        return $autores;
    }

    public function getById($id){
        $stmt = $this->cn->prepare("SELECT * FROM autores WHERE id_autor=:id");
        $stmt->execute(['id'=>$id]);
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        if($d) return new Autor($d['id_autor'], $d['nombre'], $d['nacionalidad']);
        return null;
    }

    public function add(Autor $a){
        $stmt = $this->cn->prepare("INSERT INTO autores(nombre,nacionalidad) VALUES(:n,:na)");
        return $stmt->execute(['n'=>$a->getNombre(),'na'=>$a->getNacionalidad()]);
    }

    public function update(Autor $a){
        $stmt = $this->cn->prepare("UPDATE autores SET nombre=:n,nacionalidad=:na WHERE id_autor=:id");
        return $stmt->execute(['n'=>$a->getNombre(),'na'=>$a->getNacionalidad(),'id'=>$a->getId()]);
    }

    public function delete($id){
        $stmt = $this->cn->prepare("DELETE FROM autores WHERE id_autor=:id");
        return $stmt->execute(['id'=>$id]);
    }
}
?>
