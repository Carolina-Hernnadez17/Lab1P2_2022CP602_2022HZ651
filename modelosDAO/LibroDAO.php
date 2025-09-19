<?php
require_once "config/conexion.php";
require_once "modelos/Libro.php";

class LibroDAO {
    private $cn;
    public function __construct(){ $this->cn = (new ConexionRCMH())->conectarRCMH(); }

    public function getAll(){
        $stmt = $this->cn->query("SELECT * FROM libros ORDER BY titulo ASC");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $libros = [];
        foreach($data as $d){
            $libros[] = new Libro($d['id_libro'],$d['titulo'],$d['id_autor'],$d['portada'],$d['disponible']);
        }
        return $libros;
    }

    public function getById($id){
        $stmt = $this->cn->prepare("SELECT * FROM libros WHERE id_libro=:id");
        $stmt->execute(['id'=>$id]);
        $d = $stmt->fetch(PDO::FETCH_ASSOC);
        if($d) return new Libro($d['id_libro'],$d['titulo'],$d['id_autor'],$d['portada'],$d['disponible']);
        return null;
    }

    public function add(Libro $l){
        $stmt = $this->cn->prepare("INSERT INTO libros(titulo,id_autor,portada,disponible) VALUES(:t,:a,:p,:d)");
        $stmt->execute(['t'=>$l->getTitulo(),'a'=>$l->getIdAutor(),'p'=>$l->getPortada(),'d'=>$l->getDisponible()]);
        return $this->cn->lastInsertId();
    }

    public function update(Libro $l){
        $stmt = $this->cn->prepare("UPDATE libros SET titulo=:t,id_autor=:a,portada=:p,disponible=:d WHERE id_libro=:id");
        return $stmt->execute(['t'=>$l->getTitulo(),'a'=>$l->getIdAutor(),'p'=>$l->getPortada(),'d'=>$l->getDisponible(),'id'=>$l->getId()]);
    }

    public function delete($id){
        $stmt = $this->cn->prepare("DELETE FROM libros WHERE id_libro=:id");
        return $stmt->execute(['id'=>$id]);
    }
}
?>
