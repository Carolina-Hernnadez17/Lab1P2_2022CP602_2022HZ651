<?php
require_once "config/conexion.php";

class LibroCategoriaDAO {
    private $cn;
    public function __construct(){ $this->cn = (new ConexionRCMH())->conectarRCMH(); }

    public function add($id_libro,$id_categoria){
        $stmt = $this->cn->prepare("INSERT INTO libros_categorias(id_libro,id_categoria) VALUES(:l,:c)");
        return $stmt->execute(['l'=>$id_libro,'c'=>$id_categoria]);
    }

    public function deleteByLibro($id_libro){
        $stmt = $this->cn->prepare("DELETE FROM libros_categorias WHERE id_libro=:l");
        return $stmt->execute(['l'=>$id_libro]);
    }

    public function getCategoriasByLibro($id_libro){
        $stmt = $this->cn->prepare("SELECT c.id_categoria,c.nombre FROM categorias c INNER JOIN libros_categorias lc ON c.id_categoria=lc.id_categoria WHERE lc.id_libro=:l");
        $stmt->execute(['l'=>$id_libro]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
