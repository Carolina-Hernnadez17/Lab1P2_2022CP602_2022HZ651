<?php
class Libro {
    private $id_libro;
    private $titulo;
    private $id_autor;
    private $portada;
    private $disponible;

    public function __construct($id_libro = null, $titulo = null, $id_autor = null, $portada = null, $disponible = 1) {
        $this->id_libro = $id_libro;
        $this->titulo = $titulo;
        $this->id_autor = $id_autor;
        $this->portada = $portada;
        $this->disponible = $disponible;
    }

    public function getId() { return $this->id_libro; }
    public function getTitulo() { return $this->titulo; }
    public function getIdAutor() { return $this->id_autor; }
    public function getPortada() { return $this->portada; }
    public function getDisponible() { return $this->disponible; }

    public function setId($id_libro) { $this->id_libro = $id_libro; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setIdAutor($id_autor) { $this->id_autor = $id_autor; }
    public function setPortada($portada) { $this->portada = $portada; }
    public function setDisponible($disponible) { $this->disponible = $disponible; }
}
?>
