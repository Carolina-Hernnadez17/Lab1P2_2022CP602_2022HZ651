<?php
class Libro {
    private $id;
    private $titulo;
    private $id_autor;
    private $portada;
    private $disponible;

    public function __construct($id = null, $titulo = null, $id_autor = null, $portada = null, $disponible = 1){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->id_autor = $id_autor;
        $this->portada = $portada;
        $this->disponible = $disponible;
    }
    public function getId(){ return $this->id; }
    public function getTitulo(){ return $this->titulo; }
    public function getIdAutor(){ return $this->id_autor; }
    public function getPortada(){ return $this->portada; }
    public function getDisponible(){ return $this->disponible; }
    public function setTitulo($t){ $this->titulo = $t; }
    public function setIdAutor($a){ $this->id_autor = $a; }
    public function setPortada($p){ $this->portada = $p; }
    public function setDisponible($d){ $this->disponible = $d; }
}
?>
